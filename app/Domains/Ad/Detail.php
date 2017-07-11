<?php

namespace App\Domains\Ad;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'ad_id',
        'category_id',
        'filter_id',
        'input_id',
        'category',
        'filter',
        'input',
        'value',
        'price'
    ];

    /**
     * @var array
     */
    protected $dates = ['deletead'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
