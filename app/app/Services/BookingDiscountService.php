<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Repositories\BookingDiscountRepositoryInterface;
use App\DataTransferObjects\CreateBookingDiscountDto;
use App\Models\BookingDiscount;
use App\Exceptions\EventNotBookableException;

class BookingDiscountService
{
    public function __construct(
        protected BookingDiscountRepositoryInterface $bookingDiscountRepository
    ) {
    }

    public function index(int $uid = null): Collection
    {
        return $this->bookingDiscountRepository->index();
    }

    public function show(int $id): BookingDiscount {
        return $this->bookingDiscountRepository->show($id);
    }

    public function create(CreateBookingDiscountDto $data): BookingDiscount
    {
        return $this->bookingDiscountRepository->create($data);
    }

    public function update(int $id, CreateBookingDiscountDto $data): bool
    {
        return $this->bookingDiscountRepository->update($id, $data);
    }

    public function delete(int $id): bool {
        return $this->bookingDiscountRepository->delete($id);
    }
}
