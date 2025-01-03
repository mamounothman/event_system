<?php
namespace App\Repositories;

use Illuminate\Support\Collection;
use App\DataTransferObjects\CreateBookingDto;
use App\Models\Booking;
use App\Models\Event;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface{

    public function __construct(protected Booking $model) {}

    public function create(CreateBookingDto $dto, Event $event): Booking {
        return $this->model->create([
            'event_id' => $dto->event_id,
            'user_id' => request()->user()->id,
            'booking_date' => $dto->booking_date,
            'guest_name' => $dto->guest_name,
            'guest_email' => $dto->guest_email,
            'prices' => $dto->prices,
            'total_price' => $this->calculateTotal($dto->prices, $event),
            'total_guests' => $this->calculatetotalGuests($dto->prices)
        ]);
    }

    public function index(int $uid = null): Collection {
        if($uid) {
            return $this->model->where('user_id', $uid)->get();
        }
        return $this->model->all();
    }

    public function getEventBoookingsCount(int $id): int {
        return $this->model
            ->where('id', $id)
            ->get()
            ->count();
    }

    private function calculateTotal(array $prices, Event $event): float {
        $total_price  = 0.00;
        foreach($prices as $price) {
            $total_price += $price['tickets_count'] * (float)$price['price'];
        }

        $discounts = $event->discounts->all();

        $total_price = $this->applyDiscount($total_price, $discounts);

        return $total_price;
    }

    private function calculatetotalGuests(array $prices): int {
        $guest_count  = 0;
        foreach($prices as $price) {
            $guest_count += $price['tickets_count'];
        }
        return $guest_count;
    }

    private function applyDiscount($total_prices, $discounts) {
        $operator = '<';
        $conditions = [
            '<' => fn($a, $b) => $a <= $b,
            '>' => fn($a, $b) => $b <= $a,
        ];

        foreach($discounts as $discount) {
            $rule = round($discount->rule, 2);

            if($discount->invert) {
                $operator = '>';
                $rule = round(1 - $discount->rule, 2);
            }

            if($conditions[$operator](round($event->guests_counter/$event->capacity ,2), $rule)) {
                $total_prices -= $total_prices * ((int)$discount->discount_amount)/100;
            }
        }
    }
}
