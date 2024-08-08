<?php

namespace App\Services;

use App\Models\Todo;
use App\Repositories\TodoRepository\TodoRepository;
use Illuminate\Support\Collection;

class TodoService {

    protected $repo;

    public function __construct(TodoRepository $repo) {
        $this->repo = $repo;
    }

    public function getAll() : Collection {
        return $this->repo->getAll();
    }

    public function findById(string $id) : Todo {
        return $this->repo->findById($id);
    }

    public function create(array $payload) : Todo {
        return $this->repo->create($payload);
    }

    public function updateData(array $payload, string $id) : ?Todo {
        return $this->repo->updateData($payload, $id);
    }

    public function batchDelete(array $ids) : bool {
        return $this->repo->batchDelete($ids);
    }
}