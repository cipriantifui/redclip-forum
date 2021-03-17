<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * Returns a list of all items
     * @return mixed
     */
    public function index();

    /**
     * Returns a paginated list of all items
     * @param $perPage
     * @param $page
     * @return mixed
     */
    public function indexPaginated($perPage, $page);

    /**
     * Creates a new resource
     * @param array $data
     * @return mixed
     */
    public function store(array $data);

    /**
     * Returns a given model after id
     * @param $id
     * @return mixed
     */
    public function show($id);

    /**
     * Updates a given model after id
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * Deletes a model after id
     * @param $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * remove records from the database
     * @param array $data
     * @return Collection|Model
     */
    public function massDestroy(array $data);

    /**
     * Searches a resource after id and filters
     * @param $id
     * @param $filters
     * @return mixed
     */
    public function filteredShow($id, $filters);

    /**
     * update record in the database
     * @param array $data
     * @param $id
     * @param $filters
     * @return Collection|Model
     */
    public function filteredUpdate(array $data, $id, $filters);

    /**
     * Searches resource after filters
     * @param $columns
     * @param $operations
     * @param $values
     * @return Model
     */
    public function findByColumns($columns, $operations, $values);

    /**
     * Searches a resource after column
     * @param $column
     * @param $value
     * @return mixed
     */
    public function findByColumn($column, $value);

    /**
     * Stores an array of records at once
     * @param $data
     * @return bool
     */
    public function storeMany($data);
}
