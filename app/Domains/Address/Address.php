<?php

namespace App\Domains\Address;

use App\Domains\Address\Traits\ShowOnMap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use ShowOnMap, SoftDeletes;

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
        'state_id',
        'city_id',
        'state_initials',
        'show_on_map'
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
