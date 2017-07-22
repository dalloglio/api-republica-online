<?php

namespace App\Domains\User;

use App\Domains\Ad\Ad;
use App\Domains\Address\Address;
use App\Domains\Favorite\Favorite;
use App\Domains\Photo\Photo;
use App\Domains\User\Observers\UserObserver;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    const GENDER_MALE = 'Male';

    const GENDER_FEMALE = 'Female';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'email',
        'password',
        'status'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'deleted_at', 'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $casts = [
        'birthday' => 'date',
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
        static::observe(UserObserver::class);
    }

    /**
     * @return array
     */
    public static function genders()
    {
        return [
            static::GENDER_MALE,
            static::GENDER_FEMALE,
        ];
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }
}
