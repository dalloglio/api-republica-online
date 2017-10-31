<?php

namespace App\Domains\Filter;

use App\Domains\Category\Category;
use App\Domains\Filter\Observers\FilterObserver;
use App\Domains\Filter\Observers\PhotoObserver;
use App\Domains\Filter\Traits\Types;
use App\Domains\Photo\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filter extends Model
{
    use SoftDeletes, Types;

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
        'order',
        'type',
        'values',
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
     * @param $title
     */
    public function setTitleAttribute($title)
    {
        $this->attributes['slug'] = null;
        if (!empty($title)) {
            $this->attributes['slug'] = str_slug($title);
        }
        $this->attributes['title'] = $title;
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::observe(FilterObserver::class);
        static::observe(PhotoObserver::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inputs()
    {
        return $this->hasMany(Input::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @param $value
     */
    public function setValuesAttribute($value)
    {
        if ($this->attributes['type'] == 'number') {
            $array = explode('...', $value);
            $range = range($array[0], $array[1]);
            $keys = collect($range);
            $values = $keys->combine($range);
        } else {
            $collection = collect($value);
            $keys = $collection->transform(function ($item, $key) {
                return str_slug($item);
            });
            $values = $keys->combine($value);
        }
        $this->attributes['values'] = $values->toJson();
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getValuesAttribute($value)
    {
        if ($value) {
            $value = json_decode($value);
        }
        return $value;
    }
}
