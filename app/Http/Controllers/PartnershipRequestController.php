<?php

namespace App\Http\Controllers;

use App\Models\PartnershipRequest;
use App\Http\Requests\StorePartnershipRequestRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PartnershipRequestController extends Controller
{
    /**
     * Store a new partnership request from the public form
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // Company information
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:1000',
            'description' => 'nullable|string|max:2000',
            
            // Partnership details
            'services_needed' => 'nullable|array',
            'services_needed.*' => 'string|in:' . implode(',', array_keys(PartnershipRequest::AVAILABLE_SERVICES)),
            'partnership_type' => 'nullable|string|in:' . implode(',', array_keys(PartnershipRequest::PARTNERSHIP_TYPES)),
            'partnership_duration' => 'nullable|string|in:' . implode(',', array_keys(PartnershipRequest::PARTNERSHIP_DURATIONS)),
            'budget_range' => 'nullable|numeric|min:0|max:999999999.99',
            'long_term_partnership' => 'boolean',
            'collaboration_expectations' => 'nullable|string|max:2000',
        ], [
            // Custom error messages
            'name.required' => 'Company name is required.',
            'email.required' => 'Contact email is required.',
            'email.email' => 'Please enter a valid email address.',
            'website.url' => 'Please enter a valid website URL.',
            'services_needed.*.in' => 'Please select valid services from the available options.',
            'partnership_type.in' => 'Please select a valid partnership type.',
            'partnership_duration.in' => 'Please select a valid partnership duration.',
            'budget_range.numeric' => 'Budget must be a valid number.',
            'budget_range.min' => 'Budget cannot be negative.',
        ]);

        try {
            DB::beginTransaction();

            // Create the partnership request
            $partnershipRequest = PartnershipRequest::create($validated);

            DB::commit();

            Log::info('Partnership request created successfully', [
                'id' => $partnershipRequest->id,
                'company' => $partnershipRequest->name,
                'email' => $partnershipRequest->email,
            ]);

            return redirect()->route('compagnies.success')->with('success', 'Your partnership request has been submitted successfully! We will review your application and contact you soon.');
            
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to create partnership request', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'There was an error submitting your request. Please try again.');
        }
    }

    /**
     * Update partnership request status (for admin actions)
     */
    public function updateStatus(Request $request, PartnershipRequest $partnershipRequest): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:' . implode(',', array_keys(PartnershipRequest::STATUSES)),
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        try {
            $oldStatus = $partnershipRequest->status;

            $partnershipRequest->update([
                'status' => $validated['status'],
                'admin_notes' => $validated['admin_notes'] ?? $partnershipRequest->admin_notes,
                'reviewed_at' => now(),
                'reviewed_by' => auth()->id(),
            ]);

            Log::info('Partnership request status updated', [
                'id' => $partnershipRequest->id,
                'company' => $partnershipRequest->name,
                'old_status' => $oldStatus,
                'new_status' => $validated['status'],
                'updated_by' => auth()->user()->name ?? auth()->id(),
            ]);

            return redirect()->back()->with('success', 'Partnership request status updated successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to update partnership request status', [
                'id' => $partnershipRequest->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Failed to update status. Please try again.');
        }
    }

    /**
     * Get partnership request statistics (API endpoint)
     */
    public function statistics(): JsonResponse
    {
        try {
            $stats = [
                'total' => PartnershipRequest::count(),
                'pending' => PartnershipRequest::pending()->count(),
                'approved' => PartnershipRequest::approved()->count(),
                'rejected' => PartnershipRequest::rejected()->count(),
                'in_review' => PartnershipRequest::inReview()->count(),
                'contacted' => PartnershipRequest::contacted()->count(),
                'this_month' => PartnershipRequest::thisMonth()->count(),
                'last_month' => PartnershipRequest::lastMonth()->count(),
                'urgent' => PartnershipRequest::urgent()->count(),
                'with_budget' => PartnershipRequest::withBudget()->count(),
                'long_term_interest' => PartnershipRequest::longTerm()->count(),
            ];

            // Calculate trends
            $stats['monthly_change'] = $stats['last_month'] > 0 
                ? round((($stats['this_month'] - $stats['last_month']) / $stats['last_month']) * 100, 1)
                : 0;

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to get partnership statistics', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve statistics'
            ], 500);
        }
    }

    /**
     * Get partnership requests list (API endpoint)
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = PartnershipRequest::with('reviewedBy');

            // Apply filters
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            if ($request->has('partnership_type')) {
                $query->where('partnership_type', $request->partnership_type);
            }

            if ($request->has('search')) {
                $query->search($request->search);
            }

            if ($request->boolean('urgent')) {
                $query->urgent();
            }

            if ($request->boolean('long_term')) {
                $query->longTerm();
            }

            if ($request->boolean('with_budget')) {
                $query->withBudget();
            }

            // Apply sorting
            $sortBy = $request->get('sort_by', 'created_at');
            $sortDirection = $request->get('sort_direction', 'desc');
            $query->orderBy($sortBy, $sortDirection);

            // Pagination
            $perPage = min($request->get('per_page', 15), 100);
            $partnershipRequests = $query->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $partnershipRequests
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to get partnership requests list', [
                'error' => $e->getMessage(),
                'filters' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve partnership requests'
            ], 500);
        }
    }

    /**
     * Get single partnership request (API endpoint)
     */
    public function show(PartnershipRequest $partnershipRequest): JsonResponse
    {
        try {
            $partnershipRequest->load('reviewedBy');

            return response()->json([
                'success' => true,
                'data' => $partnershipRequest
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to get partnership request', [
                'id' => $partnershipRequest->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve partnership request'
            ], 500);
        }
    }

    /**
     * Bulk update partnership requests status
     */
    public function bulkUpdateStatus(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:partnership_requests,id',
            'status' => 'required|string|in:' . implode(',', array_keys(PartnershipRequest::STATUSES)),
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        try {
            DB::beginTransaction();

            $updated = PartnershipRequest::whereIn('id', $validated['ids'])
                ->update([
                    'status' => $validated['status'],
                    'admin_notes' => $validated['admin_notes'] ?? null,
                    'reviewed_at' => now(),
                    'reviewed_by' => auth()->id(),
                ]);

            DB::commit();

            Log::info('Bulk status update completed', [
                'ids' => $validated['ids'],
                'status' => $validated['status'],
                'updated_count' => $updated,
                'updated_by' => auth()->user()->name ?? auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => "Successfully updated {$updated} partnership requests.",
                'updated_count' => $updated
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to bulk update partnership requests', [
                'ids' => $validated['ids'],
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update partnership requests'
            ], 500);
        }
    }

    /**
     * Delete partnership request
     */
    public function destroy(PartnershipRequest $partnershipRequest): JsonResponse
    {
        try {
            $partnershipRequest->delete();

            Log::warning('Partnership request deleted', [
                'id' => $partnershipRequest->id,
                'company' => $partnershipRequest->name,
                'deleted_by' => auth()->user()->name ?? auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Partnership request deleted successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to delete partnership request', [
                'id' => $partnershipRequest->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete partnership request'
            ], 500);
        }
    }
}