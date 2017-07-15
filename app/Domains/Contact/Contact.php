<?php

namespace App\Domains\Contact;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'cellphone',
        'whatsapp',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'contactable_id',
        'contactable_type',
        'deleted_at'
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function contactable()
    {
        return $this->morphTo();
    }
}
