<?php

namespace App\RDias\Domain\Repositories;

use App\User;
use App\App\Domain\Repositories\BaseRepository;
use App\RDias\Domain\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    public function create(array $data)
    {
        return $this->newQuery()->create($data);
    }

    public function find($id)
    {
        return $this->newQuery()->find($id);
    }
}