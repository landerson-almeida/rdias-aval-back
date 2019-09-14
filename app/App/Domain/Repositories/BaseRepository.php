<?php

namespace App\App\Domain\Repositories;

use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\AbstractPaginator as Paginator;

abstract class BaseRepository
{
    /**
    * Namespace da model para instânciar mais tarde.
    *
    * @var string
    */
    protected $model;

    /**
    * @return EloquentQueryBuilder|QueryBuilder
    */
    protected function newQuery()
    {
        return app($this->model)->newQuery();
    }

    /**
    * @param EloquentQueryBuilder|QueryBuilder $query
    * @param int                               $take
    * @param bool                              $paginate
    *
    * @return EloquentCollection|Paginator
    */
    protected function doQuery($query = null, $take = 15, $paginate = true)
    {
        if (is_null($query)) {
            $query = $this->newQuery();
        }

        if (true == $paginate) {
            return $query->paginate($take);
        }

        if ($take > 0 || false !== $take) {
            $query->take($take);
        }

        return $query->get();
    }

    /**
    * Retorna todos os registros
    *
    * @param int  $take
    * @param bool $paginate
    *
    * @return EloquentCollection|Paginator
    */
    public function getAll($take = 15, $paginate = true)
    {
        return $this->doQuery(null, $take, $paginate);
    }

    /**
    * @param string      $column
    * @param string|null $key
    *
    * @return \Illuminate\Support\Collection
    */
    public function lists($column, $key = null)
    {
        return $this->newQuery()->lists($column, $key);
    }

    /**
    * Obtém um registro através de seu id
    * Se falhar retorna uma exceção ModelNotFoundException.
    *
    * @param int  $id
    * @param bool $fail
    *
    * @return Model
    */
    public function findByID($id, $fail = true)
    {
        if ($fail) {
            return $this->newQuery()->findOrFail($id);
        }

        return $this->newQuery()->find($id);
    }

    /**
     * Retorna a model instânciada.
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }
}