<?php

namespace App\Domains\Form;

use App\Domains\Contact\Contact;
use App\Domains\Form\Traits\FormTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes, FormTypes;

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
        'email',
        'type',
    ];

    /**
     * @var array
     */
    protected $hidden = ['deleted_at'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
