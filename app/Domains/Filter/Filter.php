<?php

namespace App\Domains\Filter;

use App\Domains\Filter\Traits\Types;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filter extends Model
{
    use SoftDeletes, Types;

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
        'type',
        'values',
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inputs()
    {
        return $this->hasMany(Input::class);
    }
}
