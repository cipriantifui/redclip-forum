<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

interface BaseServiceInterface
{
    /**
     * returns a new instance of collection resource
     * @param $data
     * @return JsonResponse
     */
    public function collectionResponse($data);

    /**
     * returns a new instance of item resource
     * @param $data
     * @return JsonResponse
     */
    public function itemResponse($data);
    /**
     * Calls the repository to retrieve a list with all the items
     * @param array $orderByColumns
     * @param array $filters
     * @return mixed
     */
    public function index(array $orderByColumns = [], $filters = []);

    /**
     * Calls the repository to retrieve a paginated list
     * @param $perPage
     * @param $page
     * @param array $orderByColumns
     * @param array $filters
     * @return JsonResponse
     */
    public function indexPaginated($perPage, $page, array $orderByColumns = [], $filters = []);

    /**
     * Calls the repository to store a new record
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $data);

    /**
     * Calls the repository to update a record
     * @param array $data
     * @param $id
     * @return JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Calls the repository to delete a record
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id);

    /**
     * Calls the repository to delete a records
     * @param array $data
     * @return JsonResponse
     */
    public function massDestroy(array $data);

    /**
     * Calls the repository to retrieve a certain record
     * @param $id
     * @return JsonResponse
     */
    public function show($id);

    /**
     * Calls the repository to retrieve a record after a column
     * @param $column
     * @param $value
     * @return mixed
     */
    public function findByColumn($column, $value);

    /**
     * Searches a resource after id and filters
     * @param $id
     * @param $filters
     * @return mixed
     */
    public function filteredShow($id, $filters);

    /**
     * Calls the repository to update a record
     * @param array $data
     * @param $id
     * @param $filters
     * @return JsonResponse
     */
    public function filteredUpdate(array $data, $id, $filters);

    /**
     * Searches a record after an array of conditions
     * @param $columns
     * @param $operations
     * @param $values
     * @return Model
     */
    public function findByColumns($columns, $operations, $values);
}
