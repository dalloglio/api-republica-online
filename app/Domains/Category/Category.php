<?php

namespace App\Domains\Category;

use App\Domains\Ad\Ad;
use App\Domains\Category\Observers\CategoryObserver;
use App\Domains\Filter\Filter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
        'status',
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
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::observe(CategoryObserver::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function filters()
    {
        return $this->belongsToMany(Filter::class)->withTimestamps();
    }

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
}
