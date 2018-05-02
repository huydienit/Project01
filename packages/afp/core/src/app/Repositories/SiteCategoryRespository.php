<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class SiteCategoryRespository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\SiteCategory';
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->where('category_id', '=', $id)->first($columns);
    }

    public function countAll()
    {
        $result = $this->model->count();
        return $result;
    }

    public function findAll($attribute, $value)
    {
        $result = $this->model->where($attribute, $value)->get();
        return $result;
    }

    public function findAllByPaginate($attribute, $value, $limit)
    {
        $result = $this->model->where($attribute, $value)->paginate($limit);
        return $result;
    }
}