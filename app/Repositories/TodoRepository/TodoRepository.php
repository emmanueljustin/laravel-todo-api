<?php

namespace App\Repositories\TodoRepository;

use App\Repositories\TodoRepository\BaseTodoRepository;
use Illuminate\Support\Collection;
use App\Models\Todo;

class TodoRepository implements BaseTodoRepository {

    public function getAll() : Collection {
        return Todo::all();
    }

    public function findById(string $id) : Todo {
        return Todo::find($id);
    }

    public function create(array $payload) : Todo {
        return Todo::create($payload);
    }

    public function updateData(array $payload, string $id) : ?Todo {
        $result = $this->findById($id);

        if ($result) {
            $result->update($payload);
            return $result;
        }

        return null;
    }

    public function batchDelete(array $ids) : bool {
        if (!empty($ids)) {
            return Todo::whereIn("id", $ids)->delete();
        }
        return false;
    }
}