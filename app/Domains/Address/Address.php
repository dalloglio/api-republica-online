<?php

namespace App\Domains\Address;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'zip_code',
        'street',
        'number',
        'sub_address',
        'neighborhood',
        'country',
        'state',
        'city',
    ];

    protected $dates = ['deleted_at'];
}
