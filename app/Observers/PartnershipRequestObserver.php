<?php

namespace App\Observers;

use App\Models\PartnershipRequest;

class PartnershipRequestObserver
{
    /**
     * Handle the PartnershipRequest "created" event.
     */
    public function created(PartnershipRequest $partnershipRequest): void
    {
        //
    }

    /**
     * Handle the PartnershipRequest "updated" event.
     */
    public function updated(PartnershipRequest $partnershipRequest): void
    {
        //
    }

    /**
     * Handle the PartnershipRequest "deleted" event.
     */
    public function deleted(PartnershipRequest $partnershipRequest): void
    {
        //
    }

    /**
     * Handle the PartnershipRequest "restored" event.
     */
    public function restored(PartnershipRequest $partnershipRequest): void
    {
        //
    }

    /**
     * Handle the PartnershipRequest "force deleted" event.
     */
    public function forceDeleted(PartnershipRequest $partnershipRequest): void
    {
        //
    }
}
