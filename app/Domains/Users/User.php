<?php

namespace App\Domains;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

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

}
