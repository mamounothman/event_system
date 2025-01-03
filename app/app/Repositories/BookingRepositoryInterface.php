<?php
namespace App\Repositories;

use App\DataTransferObjects\CreateBookingDto;
use App\Models\Event;

interface BookingRepositoryInterface {
    public function create(CreateBookingDto $dto, Event $discounts);
}
