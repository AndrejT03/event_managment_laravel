<?php

namespace App\Repositories;
use App\Models\Organizer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface OrganizerRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): Organizer;
    public function create(array $data): Organizer;
    public function update(Organizer $organizer, array $data): Organizer;
    public function delete(Organizer $organizer): bool;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
}
