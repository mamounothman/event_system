<?php

namespace App\Http\Controllers\Api\Booking;

use Illuminate\Http\Request;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Resources\BookingResource;
use App\Http\Controllers\Controller;
use App\DataTransferObjects\CreateBookingDto;
use App\Exceptions\EventNotBookableException;
use App\Services\BookingService;

class BookingController extends Controller
{
    public function __construct(protected BookingService $bookingService) {}
    public function store(CreateBookingRequest $request) {
        try {
            return BookingResource::make(
                $this->bookingService->create(
                    CreateBookingDto::fromRequest($request)
                )
            );
        } catch(EventNotBookableException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function history(Request $request) {
        $user = $request->user();
        return BookingResource::collection(
            $this->bookingService->index($user->id)
        );
    }
}
