<?php
namespace App\Repositories;

class BaseRepository implements BaseRepositoryInterface{
    public function find(int $id) {
        return $this->model->find($id);
    }
}
