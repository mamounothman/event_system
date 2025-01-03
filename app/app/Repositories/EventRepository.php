<?php
namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use App\DataTransferObjects\CreateEventDto;
use App\Models\Event;
use App\Exceptions\ModelNotFoundExcpetion;

class EventRepository extends BaseRepository implements EventRepositoryInterface{

    public function __construct(protected Event $model) {}

    public function index(int $uid = null): Collection {
        if($uid) {
            return $this->model->where('user_id', $uid)->get();
        }
        return $this->model->all();
    }

    public function show(int $id): Event {
        $event = $this->model->find($id);
        if(!$event) {
            throw new ModelNotFoundExcpetion('Invalide resource id.');
        }
        return $event;
    }

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


    public function update(int $id, CreateEventDto $dto): bool {
        $event = $this->model->find($id);
        if(!$event) {
            throw new ModelNotFoundExcpetion('Invalide resource id.');
        }
        Gate::authorize('modify', $event);

        $result = $event
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

        foreach($dto->prices as $price) {
            $event->prices()->update($price);
        }

        $discounts = [];
        foreach($dto->discounts as $discount) {
            $discounts[] = $discount['id'];
        }

        $event->discounts()->detach();
        $event->discounts()->attach($discounts);

        return $result;
    }

    public function delete(int $id): bool {
        $event = $this->model->find($id);
        if(!$event) {
            throw new ModelNotFoundExcpetion('Invalide resource id.');
        }
        Gate::authorize('modify', $event);
        return $event->delete();
    }
}
