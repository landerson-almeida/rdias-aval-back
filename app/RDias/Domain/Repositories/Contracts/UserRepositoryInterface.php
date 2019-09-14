<?php

namespace App\RDias\Domain\Repositories\Contracts;

interface UserRepositoryInterface {

    public function create(array $data);

    public function find($id);

}
