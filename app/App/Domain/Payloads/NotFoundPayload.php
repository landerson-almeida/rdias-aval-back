<?php

namespace App\App\Domain\Payloads;

class NotFoundPayload extends Payload
{
    protected $status = 404;

    public function getData() : array
    {
        return [
            'errors' => $this->data
        ];
    }
}