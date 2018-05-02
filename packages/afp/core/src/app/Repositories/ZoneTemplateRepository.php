<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class ZoneTemplateRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\ZoneTemplate';
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->where('id', '=', $id)->first($columns);
    }

    public function countAll()
    {
        $result = $this->model->where('status', '!=', -1)->count();
        return $result;
    }

    public function findAll($attribute, $value)
    {
        $result = $this->model->where('status', '!=', -1)->where($attribute, $value)->get();
        return $result;
    }

    public function findAllByPaginate($limit)
    {
        $result = $this->model->where('status', '!=', -1)->paginate($limit);
        return $result;
    }
}