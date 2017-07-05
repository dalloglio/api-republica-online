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

    /**
     * @param $value
     */
    public function setValuesAttribute($value)
    {
        if ($this->attributes['type'] == 'number') {
            $array = explode('...', '1...4');
            $range = range($array[0], $array[1]);
            $keys = collect($range);
            $values = $keys->combine($range);
        } else {
            $values = collect($value);
        }
        $this->attributes['values'] = $values->toJson();
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getValuesAttribute($value)
    {
        if ($value) {
            $value = json_decode($value, true);
        }
        return $value;
    }
}
