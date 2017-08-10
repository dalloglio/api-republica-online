<?php

namespace App\Domains\Banner;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class BannerRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Banner::class;

    /**
     * @var array
     */
    protected $relationships = ['photo'];

    /**
     * @param string $size
     * @param bool $random
     * @param int $limit
     * @param bool $paginate
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\AbstractPaginator
     */
    public function getBannersBySize($size = '', $random = true, $limit = 3, $paginate = false)
    {
        $query = $this->newQuery();
        switch ($size) {
            case '336x280':
                $query->largeRectangle();
                break;
            case '300x600':
                $query->halfPage();
                break;
            case '970x250':
                $query->outdoor();
                break;
            default:
                break;
        }
        if ($random) {
            $query->inRandomOrder();
        }
        return $this->doQuery($query, $limit, $paginate);
    }
}