<?php

namespace App\Domains\Form\Traits;

trait FormTypes
{
    /**
     * @return array
     */
    public static function types()
    {
        return [
            'contact' => 'Contato',
            'newsletter' => 'Newsletter',
            'resume' => 'Currículo'
        ];
    }

    /**
     * @return array
     */
    public static function keys()
    {
        return collect(static::types())->keys()->all();
    }

    /**
     * @return array
     */
    public static function values()
    {
        return collect(static::types())->values()->all();
    }

    /**
     * @param string $key
     * @return string
     */
    public static function type($key = '')
    {
        $types = static::types();
        if (array_key_exists($key, $types)) {
            return $types[$key];
        }
        return $key;
    }
}