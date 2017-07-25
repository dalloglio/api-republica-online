<?php

namespace App\Domains\Photo;

use App\Domains\Photo\Observers\PhotoObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $disk = 'local';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'photo',
        'name',
        'type',
        'size',
        'url',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'deleted_at',
        'photoable_id',
        'photoable_type'
    ];

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
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function photoable()
    {
        return $this->morphTo();
    }
}
