<?php

namespace App\Domains\Ad;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class AdRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Ad::class;

    /**
     * @var array
     */
    protected $relationships = ['address', 'contact', 'details', 'photos', 'user'];

    /**
     * @param int $user_id
     * @param int $limit
     * @param bool $paginate
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\AbstractPaginator
     */
    public function getAdsByUser($user_id, $limit = 20, $paginate = true)
    {
        $this->relationships = ['user', 'photo'];
        $query = $this->newQuery();
        $query->where('user_id', $user_id);
        return $this->doQuery($query, $limit, $paginate);
    }

    /**
     * @param int $user_id
     * @param int $limit
     * @param bool $paginate
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\AbstractPaginator
     */
    public function getContactsByUser($user_id, $limit = 20, $paginate = true)
    {
        $this->relationships = ['contacts', 'photo'];
        $query = $this->newQuery();
        $query->select('id', 'title', 'slug');
        $query->where('user_id', $user_id);
        return $this->doQuery($query, $limit, $paginate);
    }
}
