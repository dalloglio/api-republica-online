<?php

namespace App\Domains\Banner\Traits;

trait BannerSizes
{
    /**
     * @return array
     */
    public static function sizes()
    {
        return [
            '336x280' => 'Banner Retângulo Grande (336x280)',
            '300x600' => 'Meia página (300x600)',
            '970x250' => 'Outdoor (970x250)',
        ];
    }

    /**
     * @return array
     */
    public static function keys()
    {
        return collect(static::sizes())->keys()->all();
    }

    /**
     * @return array
     */
    public static function values()
    {
        return collect(static::sizes())->values()->all();
    }

    /**
     * @param string $key
     * @return string
     */
    public static function size($key = '')
    {
        $sizes = static::sizes();
        if (array_key_exists($key, $sizes)) {
            return $sizes[$key];
        }
        return $key;
    }
}