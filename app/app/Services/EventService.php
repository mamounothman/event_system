<?php

namespace App\Services;

use App\Repositories\EventRepositoryInterface;
use App\Models\Event;
use App\DataTransferObjects\CreateEventDto;
use App\Http\Requests\CreateEventRequest;
use Illuminate\Support\Collection;

class EventService
{
    public function __construct(
        protected EventRepositoryInterface $eventRepository
    ) {
    }

    public function index(int $uid = null): Collection
    {
        return $this->eventRepository->index($uid);
    }

    public function show(int $id): Event
    {
        return $this->eventRepository->show($id);
    }

    public function create(CreateEventDto $data): Event
    {
        return $this->eventRepository->create($data);
    }

    public function update(int $id, CreateEventDto $data): bool {
        return $this->eventRepository->update($id, $data);
    }

    public function delete(int $id): bool {
        return $this->eventRepository->delete($id);
    }

}
