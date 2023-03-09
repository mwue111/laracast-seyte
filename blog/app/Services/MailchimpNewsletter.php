<?php

namespace App\Services;

use App\Services\Newsletter;
use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
    protected $client;
    public function __construct(ApiClient $client){
        $this->client = $client;
        //constructor para probar el service container
    }

    public function subscribe(string $email, $list = null)
    { //list es por si tenemos múltiples listas

        $list ??= config('services.mailchimp.lists.subscribers'); //Si list es null, que sea config(...)

        return $this->client->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed',
        ]);
    }
}
