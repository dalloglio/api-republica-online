<?php

namespace App\Domains\Ad;

use App\Domains\Address\Address;
use App\Domains\Photo\Photo;
use App\Domains\Video\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
        'content',
        'price',
        'user_id',
        'begin',
        'end',
        'status'
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function video()
    {
        return $this->morphOne(Video::class, 'videoable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function videos()
    {
        return $this->morphMany(Video::class, 'videoable');
    }
}
