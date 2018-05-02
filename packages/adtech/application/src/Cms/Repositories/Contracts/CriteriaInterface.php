<?php

namespace Adtech\Application\Cms\Repositories\Contracts;

use Adtech\Application\Cms\Repositories\Criteria\Criteria;

/**
 * Interface CriteriaInterface
 * @package Adtech\Application\Cms\Repositories\Contracts
 */
interface CriteriaInterface
{

    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true);

    /**
     * @return mixed
     */
    public function getCriteria();

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria);

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria);

    /**
     * @return $this
     */
    public function applyCriteria();
}