<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class PublisherSiteAdxPriceDateRespository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\PublisherSiteAdxPriceDate';
    }

    public function getById($id, $date, $columns = ['*'])
    {
        return $this->model->where([
            ['siteId', '=', $id],
            ['date', '=', $date]
        ])->first($columns);
    }
}