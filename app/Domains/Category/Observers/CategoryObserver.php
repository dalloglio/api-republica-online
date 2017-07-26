<?php

namespace App\Domains\Category\Observers;

use App\Domains\Category\Category;

class CategoryObserver
{
    public function saved(Category $category)
    {
        if (request()->filters) {
            $category->filters()->sync(request()->filters);
        } else {
            $category->filters()->detach();
        }
    }

//    public function deleted(Filter $filter)
//    {
//        $this->deleteInputs($filter);
//    }
//
//    /**
//     * @param Filter $filter
//     */
//    public function deleteInputs(Filter $filter)
//    {
//        $filter->inputs()->where('filter_id', $filter->id)->delete();
//    }
}