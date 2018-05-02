<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class UserInfoRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\UserInfo';
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->where('user_id', '=', $id)->first($columns);
    }
}
