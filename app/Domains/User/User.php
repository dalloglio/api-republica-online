<?php

namespace App\Domains\User;

use App\Mail\ForgotPassword;
use App\Domains\Ad\Ad;
use App\Domains\Address\Address;
use App\Domains\Favorite\Favorite;
use App\Domains\Photo\Photo;
use App\Domains\User\Observers\AddressObserver;
use App\Domains\User\Observers\PhotoObserver;
use App\Domains\User\Observers\UserObserver;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Mail;

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
        'cpf',
        'facebook_id',
        'facebook_picture',
        'admin',
        'status'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'deleted_at', 'password', 'password_backup', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $casts = [
        'admin' => 'boolean',
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
        static::observe(PhotoObserver::class);
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

    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to(request()->email)->send(new ForgotPassword($token));
    }

    /**
     * @param $value
     */
    public function setCpfAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['cpf'] = $value;
        } else {
            $this->attributes['cpf'] = preg_replace('/\D/', '', $value);
        }
    }
}
