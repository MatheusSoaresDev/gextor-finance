<?php

namespace App\Traits;

use Illuminate\Support\Str;

Trait HasPrimaryKeyUuid
{
    /**
     *  Setup model event hooks.
     */
    public static function bootHasPrimaryKeyUuid()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    /**
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}
