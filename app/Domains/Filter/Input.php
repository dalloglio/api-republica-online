<?php

namespace App\Domains\Filter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Input extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'filter_id',
        'key',
        'value'
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }
}