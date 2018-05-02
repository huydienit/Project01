<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class PaymentMailRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\PaymentMail';
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

    public function findID($id)
    {
        $typeList = [0 => ['id' => 0, 'name' => ''], 1 => ['id' => 1, 'name' => 'CC'], 2 => ['id' => 2, 'name' => 'Bcc']];
        $site = $this->model->find($id);
        if (null != $site) {
            $site->id = $site->id;
            $site->email = $site->email;
            $site->status = $site->status;
            $site->statusLB = ($site->status == 1) ? true : false;
            $site->type = $typeList[$site->type]['name'];
            $site->success = true;
        } else {
            $site = null;
        }
        return $site;
    }
}