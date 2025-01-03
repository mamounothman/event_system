<?php
namespace App\Repositories;

use Illuminate\Support\Collection;
use App\DataTransferObjects\CreateBookingDiscountDto;
use App\Models\BookingDiscount;

class BookingDiscountRepository extends BaseRepository implements BookingDiscountRepositoryInterface{

    public function __construct(protected BookingDiscount $model) {}

    public function create(CreateBookingDiscountDto $dto): BookingDiscount {
        return $this->model->create([
            'description' => $dto->description,
            'type' => $dto->type,
            'rule' => $dto->rule,
            'discount_amount' => $dto->discount_amount,
            'invert' => $dto->invert,
        ]);
    }

    public function index(int $uid = null): Collection {
        return $this->model->all();
    }

    public function show(int $id): BookingDiscount {
        return $this->model->findOrFail($id);
    }

    public function update(int $id, CreateBookingDiscountDto $dto): bool {
        return $this->model
            ->where(['id' => $id])
            ->update([
                'description' => $dto->description,
                'type' => $dto->type,
                'discount_amount' => $dto->discount_amount,
                'invert' => $dto->invert,
            ]);
    }

    public function delete(int $id): BookingDiscount {
        return $this->model->findOrFail($id)->delete();
    }
}
