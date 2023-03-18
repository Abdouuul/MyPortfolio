<?php

namespace App\Config;

// This class is using php 8.2 which is very recent 
// Webhosting service that im using doesn't support it yet unfortunately
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
