<?php

namespace App\Domains\Partner;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
        'link'
    ];

    /**
     * @var array
     */
    protected $hidden = ['deleted_at'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
}
