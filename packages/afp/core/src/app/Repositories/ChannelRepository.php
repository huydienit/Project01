<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class ChannelRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\Channel';
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->where('channelid', '=', $id)->first($columns);
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
        $result = $this->model->paginate($limit);
        return $result;
    }
}