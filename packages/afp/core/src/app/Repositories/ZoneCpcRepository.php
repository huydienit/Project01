<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class ZoneCpcRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\ZoneCpc';
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->where('zonecpc_id', '=', $id)->first($columns);
    }

    public function countAll($site_id)
    {
        $result = $this->model->where([['status', '!=', -1], ['site_id', $site_id]])->count();
        return $result;
    }

    public function findAll($attribute, $value)
    {
        $result = $this->model->where($attribute, $value)->get();
        return $result;
    }

    public function findAllByPaginate($site_id, $limit)
    {
        $result = $this->model->where([['status', '!=', -1], ['site_id', $site_id]])->paginate($limit);
        return $result;
    }

    public function findID($id)
    {
        $item = $this->model->find($id);
        $item->id = $id;
        $item->hiddenLabelLB = ($item->hidden_label == 1) ? true : false;
        $item->statusLB = ($item->status == 1) ? true : false;
        $item->success = true;
        return $item;
    }
}