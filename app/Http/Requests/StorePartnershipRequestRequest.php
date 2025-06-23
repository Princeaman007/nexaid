<?php
namespace App\Http\Requests;

use App\Models\PartnershipRequest;
use Illuminate\Foundation\Http\FormRequest;

class StorePartnershipRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all users to submit partnership requests
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Company information
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:partnership_requests,email',
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
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Company name is required.',
            'email.required' => 'Contact email is required.',
            'email.unique' => 'A partnership request with this email already exists.',
            'website.url' => 'Please enter a valid website URL.',
            'services_needed.*.in' => 'Please select valid services from the available options.',
            'partnership_type.in' => 'Please select a valid partnership type.',
            'partnership_duration.in' => 'Please select a valid partnership duration.',
            'budget_range.numeric' => 'Budget must be a valid number.',
            'budget_range.min' => 'Budget cannot be negative.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'long_term_partnership' => $this->boolean('long_term_partnership'),
        ]);
    }
}