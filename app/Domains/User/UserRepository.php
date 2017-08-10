<?php

namespace App\Domains\User;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = User::class;

    /**
     * @var array
     */
    protected $relationships = ['address', 'photo'];

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

    public function userExists($email)
    {
        $query = $this->newQuery();
        $query->where('email', $email);
        return $query->first();
    }
}