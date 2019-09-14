<?php

namespace App\App\Domain\Payloads;

class BadRequestPayload extends Payload
{
    protected $status = 400;

    public function getData() : array
    {
        return [
            'errors' => $this->data
        ];
    }
}