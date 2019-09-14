<?php

namespace App\App\Domain\Payloads;

class DeletePayload extends Payload
{
    protected $status = 202;

    public function getData() : array
    {
        return [
            'success' => $this->data
        ];
    }
}