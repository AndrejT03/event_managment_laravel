<?php

namespace App\Observers;
use App\Enums\EventType;
use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventObserver
{
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        if(!$event->type){
            $event->type= EventType::SEMINAR;
        }
        Log::info('Event created', [
            'event_id' => $event->id,
            'event_name' => $event->name,
        ]);
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        $changes = $event->getChanges();

        if (array_key_exists('event_date', $changes)) {
            Log::info('Event date changed', [
                'event_id' => $event->id,
                'old_date' => $event->getOriginal('event_date'),
                'new_date' => $event->event_date,
            ]);
        } else {
            Log::info('Event updated', [
                'event_id' => $event->id,
                'changed' => $changes,
            ]);
        }
    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        Log::warning('Event cancelled (deleted)', [
            'event_id' => $event->id,
            'name' => $event->name,
        ]);
    }

    /**
     * Handle the Event "restored" event.
     */
    public function restored(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     */
    public function forceDeleted(Event $event): void
    {
        //
    }
}
