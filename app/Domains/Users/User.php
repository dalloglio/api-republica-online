<?php

namespace App\Domains\Users;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

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
