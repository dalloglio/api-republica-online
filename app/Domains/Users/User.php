<?php

namespace App\Domains\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

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
