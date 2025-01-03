<?php
namespace App\Repositories;

use Illuminate\Support\Collection;
use App\DataTransferObjects\CreateEventDto;
use App\Models\Event;

class EventRepository extends BaseRepository implements EventRepositoryInterface{

    public function __construct(protected Event $model) {}

    public function create(CreateEventDto $dto): Event {
        $event = $this->model->create([
            'user_id' => $dto->user_id,
            'title' => $dto->title,
            'description' => $dto->description,
            'capacity' => $dto->capacity,
            'start_date' => $dto->start_date,
            'end_date' => $dto->end_date,
            'status' => $dto->status
        ]);
        foreach($dto->prices as $price) {
            $event->prices()->create($price);
        }

        $discounts = [];
        foreach($dto->discounts as $discount) {
            $discounts[] = $discount['id'];
        }

        $event->discounts()->attach($discounts);

        return $event;
    }

    public function index(int $uid = null): Collection {
        if($uid) {
            return $this->model->where('user_id', $uid)->get();
        }
        return $this->model->all();
    }

    public function show(int $id): Event {
        return $this->model->findOrFail($id);
    }

    public function update(int $id, CreateEventDto $dto): bool {
        return $this->model
            ->where(['id' => $id])
            ->update([
                'user_id' => $dto->user_id,
                'title' => $dto->title,
                'description' => $dto->description,
                'capacity' => $dto->capacity,
                'start_date' => $dto->start_date,
                'end_date' => $dto->end_date,
                'status' => $dto->status
            ]);

            //TODO update prices here too
            // foreach($dto->prices as $price) {
            //     $event->prices()->create($price);
            // }
    }

    public function delete(int $id): bool {
        return $this->model->findOrFail($id)->delete();
    }
}
