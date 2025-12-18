<?php

namespace App\Repositories;
use App\Models\Organizer;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrganizerRepository implements OrganizerRepositoryInterface
{
    public function all(): Collection
    {
        return Organizer::query()->latest()->get();
    }

    public function find(int $id): Organizer
    {
        return Organizer::query()->with('events')->findOrFail($id);
    }

    public function create(array $data): Organizer
    {
        return Organizer::query()->create($data);
    }

    public function update(Organizer $organizer, array $data): Organizer
    {
        $organizer->update($data);

        return $organizer->refresh();
    }

    public function delete(Organizer $organizer): bool
    {
        return (bool) $organizer->delete();
    }
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Organizer::query()
            ->withCount('events')
            ->latest()
            ->paginate($perPage);
    }
}
