<?php

namespace App\Domains\Ads;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use SoftDeletes;

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

    protected $dates = ['deleted_at'];
}
