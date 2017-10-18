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
        $cidade = null,
        $price_min = null,
        $price_max = null,
        $filters = []
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

        if (!is_null($price_min) && !is_null($price_max)) {
            $query->whereBetween('price', [$price_min, $price_max]);
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

        if (is_array($filters) && !empty($filters)) {
            foreach ($filters as $key => $value) {
                $query->whereHas('details', function ($query) use ($key, $value) {
                    $query->where([
                        ['filter', $key],
                        ['input', $value],
                    ]);
                });
            }
        }

        $query->with($this->relationships);
        if ($order === 'latest') {
            $query->latest();
        } else if ($order === 'oldest') {
            $query->oldest();
        }
        return $this->doQuery($query, $limit, $paginate);
    }

    public function getFilterPrices()
    {
        $query = $this->newQuery();
        $min = (double) $query->where('status', true)->min('price');
        $max = (double) $query->where('status', true)->max('price');
        return compact('min', 'max');
    }

    public function getFilterCategories()
    {
        $query = $this->newQuery();
        $query->with('category');
        $query->where('status', true);
        $ads = $query->get();

        $categories = $ads->mapWithKeys(function ($item, $key) {
            $category = $item->category;
            return [$category->id => [
                    'id' => $category->id,
                    'slug' => $category->slug,
                    'title' => $category->title,
                ]
            ];
        });

        $sorted = collect($categories->all())->sortBy('title');
        return $sorted->values()->all();
    }

    public function getFilterStates()
    {
        $query = $this->newQuery();
        $query->with('address');
        $query->where('status', true);
        $query->whereHas('address', function ($query) {
            $query->whereNotNull('state_id')->whereNotNull('state_initials')->whereNotNull('state');
        });
        $ads = $query->get();

        $states = $ads->mapWithKeys(function ($item, $key) {
            $state = $item->address->state;
            $state_id = $item->address->state_id;
            $state_initials = $item->address->state_initials;

            return [$state_id => [
                    'ID' => $state_id,
                    'Sigla' => $state_initials,
                    'Nome' => $state
                ]
            ];
        });
        $sorted = collect($states->all())->sortBy('Sigla');
        return $sorted->values()->all();
    }

    public function getFilterStateCities($state_id)
    {
        $query = $this->newQuery();
        $query->with('address');
        $query->where('status', true);
        $query->whereHas('address', function ($query) use ($state_id) {
            $query->where('state_id', $state_id)
                ->whereNotNull('city_id')
                ->whereNotNull('city');
        });
        $ads = $query->get();

        $cities = $ads->mapWithKeys(function ($item, $key) {
            $city = $item->address->city;
            $city_id = $item->address->city_id;
            $state_id = $item->address->state_id;

            return [$state_id => [
                    'ID' => $city_id,
                    'Nome' => $city,
                    'Estado' => $state_id
                ]
            ];
        });
        $sorted = collect($cities->all())->sortBy('Nome');
        return $sorted->values()->all();
    }
}
