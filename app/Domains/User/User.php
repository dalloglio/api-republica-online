<?php

namespace App\Domains\User;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    const GENDER_MALE = 'Male';

    const GENDER_FEMALE = 'Female';

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

    protected $hidden = [
        'deleted_at', 'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public static function genders()
    {
        return [
            self::GENDER_MALE,
            self::GENDER_FEMALE,
        ];
    }
}
