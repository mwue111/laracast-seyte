<?php

namespace App\Services;
use App\Services\Newsletter;

class ConvertKitNewsletter implements Newsletter
{

	public function subscribe(string $email, string $list = null) {
        //Suscribe al usuario con la API que sea a partir de ConvertKit
	}
}
