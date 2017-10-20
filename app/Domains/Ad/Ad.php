<?php

namespace App\Domains\Ad;

use App\Domains\Ad\Observers\AddressObserver;
use App\Domains\Ad\Observers\ContactObserver;
use App\Domains\Ad\Observers\DetailObserver;
use App\Domains\Ad\Observers\PhotoObserver;
use App\Domains\Address\Address;
use App\Domains\Category\Category;
use App\Domains\Contact\Contact;
use App\Domains\Photo\Photo;
use App\Domains\User\User;
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
        'category_id',
        'user_id',
        'begin',
        'end',
        'status'
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
        'price' => 'double',
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
        static::observe(AddressObserver::class);
        static::observe(ContactObserver::class);
        static::observe(DetailObserver::class);
        static::observe(PhotoObserver::class);
    }

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(Detail::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function contact()
    {
        return $this->morphOne(Contact::class, 'contactable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
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

    /**
     * @param $value
     */
    public function setPriceAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['price'] = (double) str_replace(',', '.', str_replace('.', '', $value));
        } else {
            $this->attributes['price'] = $value;
        }
    }
}
