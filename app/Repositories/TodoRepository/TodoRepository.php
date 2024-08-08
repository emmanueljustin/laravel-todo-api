<?php

namespace App\Repositories\TodoRepository;

use App\Repositories\TodoRepository\BaseTodoRepository;
use Illuminate\Support\Collection;
use App\Models\Todo;

class TodoRepository implements BaseTodoRepository 
{

    /**
     * [getAll] method for repository based from the interface class of BaseTodoRepository.
     * Fetch all existing reqested data in database.
     */
    public function getAll() : Collection
    {
        return Todo::all();
    }

    /**
     * [findById] method for repository based from the interface class of BaseTodoRepository
     * Can be reused to access the method of finding id in database.
     */
    public function findById(string $id) : Todo
    {
        return Todo::find($id);
    }

    /**
     * [create] method for repository based from the interface class of BaseTodoRepository.
     * It creates a new data or new table if the table does not exist in database.
     */
    public function create(array $payload) : Todo
    {
        return Todo::create($payload);
    }

    /**
     * [updateData] method for repository based from the interface class of BaseTodoRepository.
     * Updates the specific data in database based on the id provided by the request.
     */
    public function updateData(array $payload, string $id) : ?Todo
    {
        $result = $this->findById($id);

        if ($result) {
            $result->update($payload);
            return $result;
        }

        return null;
    }

    /**
     * [batchDelete] method for repository based from the interface class of BaseTodoRepository.
     * Deletes the a specific or group of data in database based on id provided by the request.
     */
    public function batchDelete(array $ids) : bool
    {
        if (!empty($ids)) {
            return Todo::whereIn("id", $ids)->delete();
        }
        return false;
    }

}