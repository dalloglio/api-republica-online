<?php

namespace App\Domains\File;

use App\Domains\File\Observers\FileObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    public $disk = 'local';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'file',
        'name',
        'type',
        'size',
        'url',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'deleted_at',
        'fileable_id',
        'fileable_type'
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

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
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function fileable()
    {
        return $this->morphTo();
    }
}
