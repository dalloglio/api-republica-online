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
    protected $relationships = ['address', 'contact', 'details', 'photo', 'photos', 'user'];

    /**
     * @param int $user_id
     * @param int $limit
     * @param bool $paginate
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\AbstractPaginator
     */
    public function getAdsByUser($user_id, $limit = 20, $paginate = true)
    {
        $this->relationships = ['user', 'photo' => function ($query) {
            $query->orderBy('favorite', 1);
        }];
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

    public function getAdSite($id)
    {
        $this->relationships[] = 'user.photo';
        $this->relationships['photo'] = function ($query) {
            $query->orderBy('favorite', 1);
        };
        $query = $this->newQuery();
        $query->where('status', true);
        $query->with($this->relationships);
        return $query->find($id);
    }

    public function getAdsSite(
        $limit = 24,
        $paginate = true,
        $order = 'latest',
        $category = null,
        $uf = null,
        $cidade = null
    ) {
        $this->relationships = [
            'address',
            'details' => function ($query) {
                $query->orderBy('filter_order', 'asc');
            },
            'photo' => function ($query) {
                $query->orderBy('favorite', 1);
            }
        ];
        $query = $this->newQuery();
        $query->where('status', true);

        if (is_integer($category)) {
            $query->where('category_id', $category);
        }

        if (!is_null($uf)) {
            $query->whereHas('address', function ($query) use ($uf) {
                $query->where('state_initials', $uf);
            });
        }

        if (!is_null($cidade)) {
            $query->whereHas('address', function ($query) use ($cidade) {
                $query->where('city', $cidade);
            });
        }

        $query->with($this->relationships);
        if ($order === 'latest') {
            $query->latest();
        } else if ($order === 'oldest') {
            $query->oldest();
        }
        return $this->doQuery($query, $limit, $paginate);
    }
}
