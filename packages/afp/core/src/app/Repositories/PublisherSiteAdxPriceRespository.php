<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class PublisherSiteAdxPriceRespository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\PublisherSiteAdxPrice';
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->where('siteId', '=', $id)->first($columns);
    }
}