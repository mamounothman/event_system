<?php

namespace App\Http\Controllers\Api\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Requests\CreateEventRequest;
use App\Models\Event;
use App\Models\TicketType;
use App\Repositories\EventRepository;
use App\DataTransferObjects\CreateEventDto;
use App\Services\EventService;
use App\Exceptions\NotAuthorizedException;
use App\Exceptions\ModelNotFoundExcpetion;


class EventController extends Controller
{

    public function __construct(protected EventService $eventService) {}

    public function index() {
        return EventResource::collection(
            $this->eventService->index()
        );
    }

    public function userIndex(Request $request) {
        $user = $request->user();
        return EventResource::collection(
            $this->eventService->index($user->id)
        );
    }

    public function show($event) {
        try {
            return EventResource::make(
                $this->eventService->show($event)
            );
        }
        catch(NotAuthorizedException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function store(CreateEventRequest $request) {
        return EventResource::make(
            $this->eventService->create(
                CreateEventDto::fromRequest($request)
            )
        );
    }

    public function update(int $event, CreateEventRequest $request) {
        try {
            return $this->eventService->update(
                $event,
                CreateEventDto::fromRequest($request)
            );
        }
        catch(NotAuthorizedException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function delete(int $event, Request $request) {
        try {
            return $this->eventService->delete($event);
        }
        catch(NotAuthorizedException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
        catch(ModelNotFoundExcpetion $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
