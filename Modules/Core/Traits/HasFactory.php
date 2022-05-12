<?php

namespace Modules\Core\Traits;

trait HasFactory
{
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        $class = explode("\\", get_called_class());

        $class[2] = "Database\\factories";
        $class[3] = $class[3]."Factory";

        $class = implode("\\",$class);

        return $class::new();
    }
}
