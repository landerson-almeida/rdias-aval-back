<?php

namespace App\App\Domain\Payloads;

class ValidationPayload extends Payload
{
    protected $status = 422;

    public function getData() : array
    {
        return [
            'errors' => $this->data
        ];
    }
}