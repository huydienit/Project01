<?php

namespace Adtech\Application\Cms\Repositories\Criteria;

use Adtech\Application\Cms\Repositories\Contracts\RepositoryInterface as Repository;

abstract class Criteria
{

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}