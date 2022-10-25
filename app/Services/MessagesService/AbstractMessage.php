<?php

namespace App\Services\MessagesService;

class AbstractMessage
{
    protected $address;

    public function setAddress($address)
    {
        $this->address = $address;
    }
}
