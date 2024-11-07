<?php

if (!function_exists('initial') )
{
    function initial(string $fullName): string
    {
        $parts = \Illuminate\Support\Arr::map(explode(' ', $fullName), static function ($item) {
            return ucfirst(substr($item, 0, 1));
        });

        return substr(implode('', $parts), 0, 2);
    }
}
