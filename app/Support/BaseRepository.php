<?php

namespace App\Support;

use App\Support\Contracts\BaseRepository as BaseRepositoryContract;
use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\AbstractPaginator as Paginator;

abstract class BaseRepository implements BaseRepositoryContract
{
    /**
     * @var string $modelClass
     */
    protected $modelClass;

    /**
     * @var array
     */
    protected $relationships = [];

    /**
     * @param EloquentQueryBuilder|QueryBuilder $query
     * @param int $take
     * @param bool $paginate
     * @return EloquentCollection|Paginator
     */
    protected function doQuery($query = null, $take = 200, $paginate = true)
    {
        if (is_null($query)) {
            $query = $this->newQuery();
        }

        if (!empty($this->relationships)) {
            $query->with($this->relationships);
        }

        if (true == $paginate) {
            return $query->paginate($take);
        }

        if ($take > 0 || false !== $take) {
            $query->take($take);
        }

        return $query->get();
    }

    /**
     * @return EloquentQueryBuilder|Paginator
     */
    protected function newQuery()
    {
        return app($this->modelClass)->newQuery();
    }

    /**
     * @param int $take
     * @param bool $paginate
     * @return EloquentCollection|Paginator
     */
    public function getAll($take = 200, $paginate = true)
    {
        return $this->doQuery(null, $take, $paginate);
    }

    /**
     * @param string $column
     * @param string|null $key
     * @return \Illuminate\Support\Collection|array
     */
    public function lists($column, $key = null)
    {
        return $this->newQuery()->pluck($column, $key);
    }

    /**
     * @param int $id
     * @param bool $fail
     * @return Model
     */
    public function findById($id, $fail = true)
    {
        $id = (int) $id;
        if ($fail) {
            return $this->newQuery()->with($this->relationships)->findOrFail($id);
        }
        return $this->newQuery()->with($this->relationships)->find($id);
    }
}