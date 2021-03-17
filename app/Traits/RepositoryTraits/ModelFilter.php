<?php

namespace App\Traits\RepositoryTraits;


trait ModelFilter
{
    /**
     * Used to order data in collection
     * An example of $orderByColumns would be:
     *[
     * "name" => "asc"
     * ]
     * @param $orderByColumns
     * @return Model
     */
    public function order($orderByColumns)
    {
        if (count($orderByColumns)) {
            $modelColumns = $this->getModelColumns();
            foreach ($orderByColumns as $column => $order) {
                if (isset($modelColumns[$column])) {
                    $this->model = $this->model->orderBy($column, $order);
                }
            }
        }
        return $this->model = $this->model->orderBy('id', 'desc');
    }

    /**
     * Retrieves a list with all of the model's columns
     * @return array|null
     */
    public function getModelColumns()
    {
        return array_flip(array_merge($this->model->getFillable(), ['created_at', 'updated_at']));
    }

    /**
     * Used to filter the model after the given input.
     * An example of $filters would be:
     * {
     *  "columns" => ["name", "age"],
     *  "operations" => ["like", "<"],
     *  "values" => ["John", 35]
     * }
     * @param $filters
     * @return Model
     */
    public function filterModel($filters)
    {
        if (!is_array($filters)) {
            $filters = json_decode($filters, true);
        }
        if (count($filters)) {
            $this->model = $this->model->where(function ($modelQuery) use ($filters) {
                $modelColumns = $this->getModelColumns();
                foreach ($filters['columns'] as $key => $column) {
                    if (isset($modelColumns[$column])) {
                        $modelQuery = $this->handleFiltering($modelQuery, $column, $filters['operations'][$key], $filters['values'][$key]);
                    }
                }
                return $modelQuery;
            });
        }
        return $this->model;
    }

    /**
     * Generates an orWhere that filters the model after the given input
     * @param $model
     * @param $column
     * @param $operation
     * @param $value
     * @return mixed
     */
    public function handleFiltering($model, $column, $operation, $value)
    {
        if (in_array(strtolower($operation), ['like', 'ilike', 'not like', 'not ilike'])) {
            $value = '%' . $value . '%';
            return $model->where($column, $operation, $value);
        }
        if (in_array(strtolower($operation), ['in', 'not in'])) {
            return $model->whereIn($column, $value);
        }
        if(in_array(strtolower($operation), ['gte', 'lte'])){
            return $model;
        }
        return $model->where($column, $operation, $value);

    }
}
