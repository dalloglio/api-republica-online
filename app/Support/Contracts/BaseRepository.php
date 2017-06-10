<?php

namespace App\Support\Contracts;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractPaginator as Paginator;

interface BaseRepository
{
    /**
     * @param int $take
     * @param bool $paginate
     * @return EloquentCollection|Paginator
     */
    public function getAll($take = 15, $paginate = true);

    /**
     * @param int $id
     * @param bool $fail
     * @return Model
     */
    public function findByID($id, $fail = true);

    /**
     * @param string $column
     * @param string|null $key
     * @return mixed
     */
    public function lists($column, $key = null);
}