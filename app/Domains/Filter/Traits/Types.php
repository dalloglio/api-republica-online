<?php

namespace App\Domains\Filter\Traits;

trait Types
{
    private static $types = [
        'checkbox' => 'Checkbox',
        'number' => 'Number',
        'radio' => 'Radio',
        'select' => 'Select',
        'price' => 'Preço'
    ];

    protected static function types()
    {
        return self::$types;
    }

    protected static function keys()
    {
        return collect(self::types())->keys()->all();
    }

    protected static function values()
    {
        return collect(self::types())->values()->all();
    }
}