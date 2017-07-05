<?php

namespace App\Observers;

use App\Domains\Filter\Filter;

class FilterObserver
{
    /**
     * @param Filter $filter
     */
    public function saved(Filter $filter)
    {
        if ($filter->values) {
            $this->deleteInputs($filter);
            $values = collect($filter->values);
            $values->each(function ($value, $key) use ($filter) {
                $filter->inputs()->create([
                    'key' => $key,
                    'value' => $value
                ]);
            });
        }
    }

    /**
     * @param Filter $filter
     */
    public function deleted(Filter $filter)
    {
        $this->deleteInputs($filter);
    }

    /**
     * @param Filter $filter
     */
    public function deleteInputs(Filter $filter)
    {
        $filter->inputs()->where('filter_id', $filter->id)->delete();
    }
}