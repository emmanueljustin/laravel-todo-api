<?php

namespace App\Repositories\TodoRepository;

use App\Models\Todo;
use Illuminate\Support\Collection;

interface BaseTodoRepository {
    public function getAll() : Collection;
    public function findById(string $id) : Todo;
    public function create(array $payload) : Todo;
    public function updateData(array $payload, string $id) : ?Todo;
    public function batchDelete(array $ids) : bool;
}