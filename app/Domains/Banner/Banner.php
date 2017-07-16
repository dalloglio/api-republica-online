<?php

namespace App\Domains\Banner;

use App\Domains\Banner\Observers\PhotoObserver;
use App\Domains\Banner\Traits\BannerSizes;
use App\Domains\Photo\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes, BannerSizes;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'link',
        'size'
    ];

    /**
     * @var array
     */
    protected $hidden = ['deleted_at'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::observe(PhotoObserver::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
}
