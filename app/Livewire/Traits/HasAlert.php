<?php

namespace App\Livewire\Traits;

use App\Livewire\Elements\Alert;

/**
 * @method void error(string $message)
 * @method void info(string $message)
 * @method void success(string $message)
 * @method void warning(string $message)
 */
trait HasAlert
{
    public function __call($method, $arguments)
    {
        $severities = [
            'error',
            'info',
            'success',
            'warning',
        ];
        [$message] = $arguments;
        if (in_array($method, $severities, true)) {
            $this->dispatch('show', $message, $method)
                ->to(Alert::class);
            return null;
        }

        return parent::__call(...func_get_args());
    }
}
