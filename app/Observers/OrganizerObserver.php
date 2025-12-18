<?php

namespace App\Observers;

use App\Models\Organizer;
use Illuminate\Support\Facades\Log;

class OrganizerObserver
{
    /**
     * Handle the Organizer "created" event.
     */
    public function created(Organizer $organizer): void
    {
        Log::info('Organizer created', [
            'organizer_id' => $organizer->id,
            'organizer_name' => $organizer->full_name,
        ]);
    }

    /**
     * Handle the Organizer "updated" event.
     */
    public function updated(Organizer $organizer): void
    {
        Log::info('Organizer updated', [
            'organizer_id' => $organizer->id,
            'changed' => $organizer->getChanges(),
        ]);
    }

    /**
     * Handle the Organizer "deleted" event.
     */
    public function deleted(Organizer $organizer): void
    {
        Log::warning('Organizer deleted', [
            'organizer_id' => $organizer->id,
            'email' => $organizer->email,
        ]);
    }

    /**
     * Handle the Organizer "restored" event.
     */
    public function restored(Organizer $organizer): void
    {
        //
    }

    /**
     * Handle the Organizer "force deleted" event.
     */
    public function forceDeleted(Organizer $organizer): void
    {
        //
    }
}
