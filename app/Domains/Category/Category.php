<?php

namespace App\Domains\Category;

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
    protected $dates = ['deleted_at'];
}
