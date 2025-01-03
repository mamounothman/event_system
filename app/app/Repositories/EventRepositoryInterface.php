<?php
namespace App\Repositories;

use App\DataTransferObjects\CreateEventDto;

interface EventRepositoryInterface {
    public function create(CreateEventDto $dto);
    public function index();
    public function show(int $id);
    public function update(int $id, CreateEventDto $dto);
    public function delete(int $id);
}
