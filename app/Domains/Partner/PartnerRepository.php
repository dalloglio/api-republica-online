<?php

namespace App\Domains\Partner;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class PartnerRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Partner::class;

    /**
     * @var array
     */
    protected $relationships = ['photo'];

    public function getAllSite($limit = 20, $paginate = false, $random = false)
    {
        $query = $this->newQuery();
        if ($random) {
            $query->inRandomOrder();
        }
        return $this->doQuery($query, $limit, $paginate);
    }
}
