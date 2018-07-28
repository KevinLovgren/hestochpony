<?php

namespace App\Traits;

trait AuditTrait {

    public static function boot()
    {
        parent::boot();

        // This is how we catch standard eloquent events
        static::updating(function ($model) {
            \App\Audit::audit("Update", $model, $model->original, $model->attributes);
        });
    }
}
