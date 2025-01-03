<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Repositories\BookingRepositoryInterface;
use App\Repositories\EventRepositoryInterface;
use App\DataTransferObjects\CreateBookingDto;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Booking;
use App\Models\Event;

use App\Exceptions\EventNotBookableException;

class BookingService
{
    private Event $event;
    public function __construct(
        protected BookingRepositoryInterface $bookingRepository,
        protected EventRepositoryInterface $eventRepository
    ) {
    }

    public function create(CreateBookingDto $data): Booking
    {
        $this->isBookableEvent($data);
        return $this->bookingRepository->create($data, $this->event);
    }

    public function index(int $uid = null): Collection
    {
        return $this->bookingRepository->index($uid);
    }

    private function isBookableEvent($data) {
        $event = $this->eventRepository->show($data->event_id);

        if($event->status === 0) {
            throw new EventNotBookableException('Event is closed.');
        }

        if($event->guests_counter >= $event->capacity) {
            throw new EventNotBookableException('Event is fully booked.');
        }

        $guest_count  = 0;
        foreach($data->prices as $price) {
            $guest_count += $price['tickets_count'];
        }

        if($guest_count + $event->guests_counter > $event->capacity) {
            throw new EventNotBookableException('Capacity reached, please try less number of tickets.');
        }

        if($data->booking_date->gt($event->end_date)) {
            throw new EventNotBookableException('Invalid booking date!');
        }

        $this->event = $event;
    }
}
