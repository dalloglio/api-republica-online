<?php

namespace App\Domains\Category;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class CategoryRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Category::class;

    /**
     * @var array
     */
    protected $relationships = ['filters.inputs'];

    public function getListsSite($order = 'title', $column = 'title', $key = 'id')
    {
        return $this->newQuery()->orderBy($order)->pluck($column, $key);
    }

    public function getCategoriesSite($limit = 100, $paginate = false, $order = 'title')
    {
        $this->relationships['filters'] = function ($query) {
            $query->orderBy('order');
        };
        $query = $this->newQuery();
        $query->orderBy($order);
        return $this->doQuery($query, $limit, $paginate);
    }
}
