<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        // Validation étendue pour correspondre à votre formulaire
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
            'rgpd_consent' => 'required|accepted'
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'message.required' => 'Le message est obligatoire.',
            'message.max' => 'Le message ne peut pas dépasser 2000 caractères.',
            'rgpd_consent.required' => 'Vous devez accepter notre politique de confidentialité.',
        ]);

        try {
            // Préparer les données pour l'email
            $contactData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'subject' => $validated['subject'] ?? 'Autre',
                'message' => $validated['message'],
                'ip_address' => $request->ip(),
                'submitted_at' => now()
            ];

            // CHANGEZ CETTE ADRESSE PAR VOTRE EMAIL !
            $adminEmail = 'tfeetude@gmail.com'; // ← Mettez votre vraie adresse ici

            // Envoyer l'email à vous
            Mail::to($adminEmail)->send(new ContactFormMail($contactData));

            // Email de confirmation automatique au visiteur
            $this->sendConfirmationToUser($contactData);

            // Log pour traçabilité
            Log::info('Contact form submitted', [
                'name' => $contactData['name'],
                'email' => $contactData['email'],
                'subject' => $contactData['subject']
            ]);

            return back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');

        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['email' => 'Une erreur est survenue lors de l\'envoi. Veuillez réessayer.']);
        }
    }

    private function sendConfirmationToUser($contactData)
    {
        try {
            // Email de confirmation simple au visiteur
            Mail::raw("
Bonjour {$contactData['name']},

Nous avons bien reçu votre message concernant : {$contactData['subject']}

Votre demande :
{$contactData['message']}

Notre équipe va traiter votre demande et vous répondra dans les 24h.

Merci de votre confiance !

L'équipe " . config('app.name') . "

---
Cet email est envoyé automatiquement, merci de ne pas y répondre.
            ", function ($mail) use ($contactData) {
                $mail->to($contactData['email'])
                     ->subject('Confirmation de réception - ' . config('app.name'));
            });
        } catch (\Exception $e) {
            // Si l'email de confirmation échoue, on continue quand même
            Log::warning('Confirmation email failed: ' . $e->getMessage());
        }
    }
}