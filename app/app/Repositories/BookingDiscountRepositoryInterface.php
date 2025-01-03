<?php
namespace App\Repositories;

use App\DataTransferObjects\CreateBookingDiscountDto;

interface BookingDiscountRepositoryInterface {
    public function create(CreateBookingDiscountDto $dto);
}
