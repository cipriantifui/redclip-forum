<?php


namespace App\Repositories;

use App\Traits\RepositoryTraits\ModelFilter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    use ModelFilter;
    /**
     * model property on class instances
     *
     */
    protected $model;

    /**
     * Constructor to bind model to repo
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all instances of model
     * @param array $orderByColumns
     * @param array $filters
     * @return Collection|Model[]
     */
    public function index(array $orderByColumns = [], $filters = [])
    {
        $this->filterModel($filters);
        $this->order($orderByColumns);
        return $this->model->get();
    }

    /**
     * Returns a paginated collection of the model
     * @param $perPage
     * @param $page
     * @param array $orderByColumns
     * @param array $filters
     * @return mixed
     */
    public function indexPaginated($perPage, $page, array $orderByColumns = [], $filters = [])
    {
        $this->filterModel($filters);
        $this->order($orderByColumns);
        return $this->model->paginate($perPage);
    }

    /**
     * create a new record in the database
     * @param array $data
     * @return Model
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * update record in the database
     * @param array $data
     * @param $id
     * @return Collection|Model
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * remove record from the database
     * @param $id
     * @return Collection|Model
     * @throws \Exception
     */
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        return $record;
    }

    /**
     * remove records from the database
     * @param array $data
     * @return Collection|Model
     */
    public function massDestroy(array $data)
    {
        return $this->model->whereIn('id', $data)->delete();
    }

    /**
     * show the record with the given id
     * @param $id
     * @return Collection|Model
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $column
     * @param $value
     * @return Model
     */
    public function findByColumn($column, $value) {
        return $this->model->where($column, $value)->first();
    }

    /**
     * Searches resource after filters
     * @param $columns
     * @param $operations
     * @param $values
     * @return Model
     */
    public function findByColumns($columns, $operations, $values) {
        $modelQuery = $this->model;
        foreach ($columns as $index => $columnValue) {
            $modelQuery = $modelQuery->where($columnValue, $operations[$index], $values[$index]);
        }
        return $modelQuery->firstOrFail();
    }
    /**
     * Searches a resource after id and filters
     * @param $id
     * @param $filters
     * @return mixed
     */
    public function filteredShow($id, $filters) {
        $this->filterModel($filters);
        return $this->model->findOrFail($id);
    }

    /**
     * update record in the database
     * @param array $data
     * @param $id
     * @param $filters
     * @return Collection|Model
     */
    public function filteredUpdate(array $data, $id, $filters)
    {
        $this->filterModel($filters);
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Stores an array of records at once
     * @param $data
     * @return bool
     */
    public function storeMany($data) {
        return $this->model->insert($data);
    }
}
