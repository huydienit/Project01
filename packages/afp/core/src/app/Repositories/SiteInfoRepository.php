<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class SiteInfoRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\SiteInfo';
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->where('site_id', '=', $id)->first($columns);
    }
}