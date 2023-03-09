<?php

namespace App\Services;

interface Newsletter{
    //Interfaz o contrato
    public function subscribe(string $email, string $list = null);
}
