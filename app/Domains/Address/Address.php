<?php

namespace App\Domains\Address;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
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

    /**
     * @var array
     */
    protected $hidden = [
        'deleted_at',
        'addressable_id',
        'addressable_type'
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addressable()
    {
        return $this->morphTo();
    }
}
