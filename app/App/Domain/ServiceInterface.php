<?php

namespace App\App\Domain;

use App\App\Domain\Payloads\Payload;

interface ServiceInterface
{
    public function handle(array $data = []) : Payload;
}