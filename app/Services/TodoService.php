<?php

namespace App\Services;

use App\Models\Todo;
use App\Repositories\TodoRepository\TodoRepository;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\CustomTodoPaginationResource;

class TodoService
{

    protected $repo;

    /**
     * Constructor for class TodoService and initializes the TodoRepository and it's methods.
     */
    public function __construct(TodoRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * [getAll] method for TodoService can be reused in different controllers if needed to avoid multiple and repetitive method implementation
     */
    public function getAll() : Collection
    {
        return $this->repo->getAll();
    }

    /**
     * [getAllSpecific] method used to access TodoRepository
     */
    public function getAllSpecific(array $payload) : CustomTodoPaginationResource
    {
        return $this->repo->getAllSpecific($payload);
    }

    /**
     * [findById] method for TodoService can be reused in different controllers if needed to avoid multiple and repetitive method implementation
     */
    public function findById(string $id) : Todo
    {
        return $this->repo->findById($id);
    }

    /**
     * [create] method for TodoService can be reused in different controllers if needed to avoid multiple and repetitive method implementation
     */
    public function create(array $payload) : Todo
    {
        return $this->repo->create($payload);
    }

    /**
     * [updateData] method for TodoService can be reused in different controllers if needed to avoid multiple and repetitive method implementation
     */
    public function updateData(array $payload, string $id) : ?Todo
    {
        return $this->repo->updateData($payload, $id);
    }

    /**
     * [batchDelete] method for TodoService can be reused in different controllers if needed to avoid multiple and repetitive method implementation
     */
    public function batchDelete(array $ids) : bool
    {
        return $this->repo->batchDelete($ids);
    }
}
