<?php

namespace App\Services;

use App\Models\Option as OptionModel;

class Option
{
    public function get(string $name)
    {
        $option = OptionModel::where('name', $name)->first();
        if ($option) {
            return $option->value;
        } else {
            return null;
        }
    }

    public function set(string $name, string $value)
    {
        OptionModel::updateOrCreate(
            ['name' => $name],
            ['value' => $value],
        );
    }
}
