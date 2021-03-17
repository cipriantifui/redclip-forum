<?php


namespace App\Services;


use App\Repositories\BaseRepositoryInterface;
use App\Traits\ApiResponses\ApiResponses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class BaseService
{
    use ApiResponses;
    protected $itemResource;
    protected $collectionResource;
    protected $repository;

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * returns a new instance of collection resource
     * @param $data
     * @return JsonResponse
     */
    public function collectionResponse($data)
    {
        return $this->collection($data);
    }

    /**
     * returns a new instance of item resource
     * @param $data
     * @return JsonResponse
     */
    public function itemResponse($data)
    {
        return $this->item($data);
    }

    /**
     * Calls the repository to retrieve a list with all the items
     * @param array $orderByColumns
     * @param array $filters
     * @return mixed
     */
    public function index(array $orderByColumns = [], $filters = [])
    {
        return $this->collectionResponse($this->repository->index($orderByColumns, $filters));
    }

    /**
     * Calls the repository to retrieve a paginated list
     * @param $perPage
     * @param $page
     * @param array $orderByColumns
     * @param array $filters
     * @return JsonResponse
     */
    public function indexPaginated($perPage, $page, array $orderByColumns = [], $filters = [])
    {
        return $this->collectionResponse($this->repository->indexPaginated($perPage, $page, $orderByColumns, $filters));
    }

    /**
     * Calls the repository to store a new record
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $data)
    {
        return $this->itemResponse($this->rawCreate($data));
    }

    /**
     * Calls the repository to store a new record
     * @param array $data
     * @return JsonResponse
     */
    public function rawCreate(array $data)
    {
        return $this->repository->store($data);
    }

    /**
     * Calls the repository to update a record
     * @param array $data
     * @param $id
     * @return JsonResponse
     */
    public function update(array $data, $id)
    {
        return $this->itemResponse($this->repository->update($data, $id));
    }

    /**
     * Calls the repository to delete a record
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        return $this->itemResponse($this->repository->destroy($id));
    }

    /**
     * Calls the repository to delete a records
     * @param array $data
     * @return JsonResponse
     */
    public function massDestroy(array $data)
    {
        return $this->itemResponse($this->repository->massDestroy($data));
    }

    /**
     * Calls the repository to retrieve a certain record
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return $this->itemResponse($this->repository->show($id));
    }

    /**
     * Calls the repository to retrieve a record after a column
     * @param $column
     * @param $value
     * @return mixed
     */
    public function findByColumn($column, $value)
    {
        return $this->repository->findByColumn($column, $value);
    }

    /**
     * Searches a record after an array of conditions
     * @param $columns
     * @param $operations
     * @param $values
     * @return Model
     */
    public function findByColumns($columns, $operations, $values) {
        return $this->repository->findByColumns($columns, $operations, $values);
    }
    /**
     * Searches a resource after id and filters
     * @param $id
     * @param $filters
     * @return mixed
     */
    public function filteredShow($id, $filters) {
        return $this->repository->filteredShow($id, $filters);
    }

    /**
     * Calls the repository to update a record
     * @param array $data
     * @param $id
     * @param $filters
     * @return JsonResponse
     */
    public function filteredUpdate(array $data, $id, $filters) {
        return $this->itemResponse($this->repository->filteredUpdate($data, $id, $filters));
    }
}

