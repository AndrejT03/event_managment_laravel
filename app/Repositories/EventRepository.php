<?php

namespace App\Repositories;
use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EventRepository implements EventRepositoryInterface
{
    public function paginate(int $perPage = 10, ?string $search = null): LengthAwarePaginator
    {
        return Event::query()
            ->with('organizer')
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('date')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function find(int $id): Event
    {
        return Event::query()->with('organizer')->findOrFail($id);
    }

    public function create(array $data): Event
    {
        return Event::query()->create($data);
    }

    public function update(Event $event, array $data): Event
    {
        $event->update($data);

        return $event->refresh();
    }

    public function delete(Event $event): bool
    {
        return (bool) $event->delete();
    }
}
