<?php

namespace App\Domains;

use App\Support\BaseRepository;

class UsersRepository extends BaseRepository
{
    /**
     * @var string $modelClass
     */
    protected $modelClass = User::class;

    /**
     * @param int $limit
     * @param bool $paginate
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\AbstractPaginator
     */
    public function getInactive($limit = 15, $paginate = true)
    {
        $query = $this->newQuery();
        $query->where('status', 0);
        $query->orderBy('name');
        return $this->doQuery($query, $limit, $paginate);
    }
}