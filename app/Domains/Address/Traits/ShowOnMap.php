<?php

namespace App\Domains\Address\Traits;

/**
 * Trait ShowOnMap
 * @package App\Domains\Address\Traits
 */
trait ShowOnMap
{
    /**
     * @return array
     */
    public static function options()
    {
        return [
            0 => 'Não mostrar',
            1 => 'Mostrar a localização aproximada',
            2 => 'Mostrar a localização exata'
        ];
    }

    /**
     * @return array
     */
    public static function keys()
    {
        return collect(static::options())->keys()->all();
    }

    /**
     * @return array
     */
    public static function values()
    {
        return collect(static::options())->values()->all();
    }

    /**
     * @param string $key
     * @return string
     */
    public static function size($key = '')
    {
        $options = static::options();
        if (array_key_exists($key, $options)) {
            return $options[$key];
        }
        return $key;
    }
}