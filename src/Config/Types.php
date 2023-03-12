<?php

namespace App\Config;

enum Types: string
{
    case Feature = "Feature";
    case Modif = "Modif";
    case Update = "Update";
    case Fix = "Fix";


    public function toString(): string
    {
        return $this->value;
    }
}
