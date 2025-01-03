<?php

namespace App\Http\Controllers\Api\BookingDiscount;

use Illuminate\Http\Request;
use App\Http\Requests\CreateBookingDiscountRequest;
use App\Http\Resources\BookingDiscountResource;
use App\Http\Controllers\Controller;
use App\DataTransferObjects\CreateBookingDiscountDto;
use App\Exceptions\EventNotBookableException;
use App\Services\BookingDiscountService;

class BookingDiscountController extends Controller
{
    public function __construct(protected BookingDiscountService $bookingDiscountService) {}

    public function index(Request $request) {
        return BookingDiscountResource::collection(
            $this->bookingDiscountService->index()
        );
    }

    public function show(int $id, Request $request) {
        return BookingDiscountResource::make(
            $this->bookingDiscountService->show($id)
        );
    }

    public function store(CreateBookingDiscountRequest $request) {
        return BookingDiscountResource::make(
            $this->bookingDiscountService->create(
                CreateBookingDiscountDto::fromRequest($request)
            )
        );
    }

    public function update(int $id, CreateBookingDiscountRequest $request) {
        return $this->bookingDiscountService->update(
            $id,
            CreateBookingDiscountDto::fromRequest($request)
        );
    }


    public function delete(int $id) {
        return $this->bookingDiscountService->delete($id);
    }
}
