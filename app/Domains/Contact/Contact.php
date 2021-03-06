<?php

namespace App\Domains\Contact;

use App\Domains\Contact\Observers\FileObserver;
use App\Domains\File\File;
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
        'email',
        'phone',
        'cellphone',
        'whatsapp',
        'city',
        'state',
        'origin',
        'role',
        'subject',
        'message',
        'about',
        'viewed_at',
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
    protected $dates = ['deleted_at', 'viewed_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::observe(FileObserver::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function contactable()
    {
        return $this->morphTo();
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/\D/', '', $value);
    }

    public function setCellphoneAttribute($value)
    {
        $this->attributes['cellphone'] = preg_replace('/\D/', '', $value);
    }

    public function setWhatsappAttribute($value)
    {
        $this->attributes['whatsapp'] = preg_replace('/\D/', '', $value);
    }
}
