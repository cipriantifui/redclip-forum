<?php

namespace App\Traits;

trait CommonTrait
{
    public function buildOrderFilter(array $orderByColumns): array
    {
        $key = $orderByColumns[0] ?? null;
        $value = $orderByColumns[1] ?? null;
        $arrOrderByColumns = [];
        if(isset($key) && isset($value)) {
            $arrOrderByColumns = array($key => $value);
        }

        return $arrOrderByColumns;
    }

    public function collectionFilter($collection, $orderByColumns, $model)
    {
        if (count($orderByColumns)) {
            $modelColumns = $this->getModelColumns($model);
            foreach ($orderByColumns as $column => $order) {
                if (isset($modelColumns[$column]) === false) {
                    if($order == 'asc') {
                        $collection = $collection->sortBy($column);
                    } else {
                        $collection = $collection->sortByDesc($column);
                    }
                }
            }
        }
        return $collection;
    }

    /**
     * Retrieves a list with all of the model's columns
     * @return array|null
     */
    public function getModelColumns($model)
    {
        return array_flip(array_merge($model->getFillable(), ['created_at', 'updated_at']));
    }
}
