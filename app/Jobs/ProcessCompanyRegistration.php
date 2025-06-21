<?php
namespace App\Jobs;

use App\Models\CompanyRegistration;
use App\Services\CompanyRegistrationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCompanyRegistration implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private CompanyRegistration $registration
    ) {}

    public function handle(CompanyRegistrationService $service): void
    {
        $service->processRegistration($this->registration);
    }
}