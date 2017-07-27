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

   public function deleted(Category $category)
   {
       $category->filters()->detach();
   }
}