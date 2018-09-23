<?php

namespace Terranet\Administrator\Filter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Terranet\Administrator\Contracts\Filter\Searchable;

class DateRange extends Filter implements Searchable
{
    /**
     * @param Builder $query
     * @param Model $model
     * @return Builder
     */
    public function searchBy(Builder $query, Model $model): Builder
    {
        [$date_from, $date_to] = array_values($this->value());

        if ($date_from && $date_to) {
            $query->whereDate("{$model->getTable()}.{$this->id()}", '>=', $date_from);
            $query->whereDate("{$model->getTable()}.{$this->id()}", '<=', $date_to);
        }

        return $query;
    }
}