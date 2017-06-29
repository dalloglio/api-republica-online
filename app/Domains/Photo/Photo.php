<?php

namespace App\Domains\Photo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'photo',
        'name',
        'type',
        'size',
        'url',
    ];

    protected $dates = ['deleted_at'];
}
