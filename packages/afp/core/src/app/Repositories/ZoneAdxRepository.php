<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class ZoneAdxRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\ZoneAdx';
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->where('zoneadx_id', '=', $id)->first($columns);
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

    public function findAllByPaginate($limit)
    {
        $result = $this->model->where('status', '!=', -1)->paginate($limit);
        return $result;
    }

    public function findID($id)
    {
        $item = $this->model->find($id);
        $item->id = $id;
        $item->bannerDefaultLB = ($item->is_banner_default == 1) ? true : false;
        $item->hiddenLabelLB = ($item->hidden_label == 1) ? true : false;
        $item->statusLB = ($item->status == 1) ? true : false;
        $item->success = true;
        return $item;
    }
}