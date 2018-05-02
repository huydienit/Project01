<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

class PaymentRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\Payment';
    }

    public function countAll($begin, $end)
    {
        $result = $this->model->with('site')
            ->where([['begin', $begin], ['end', $end]])->count();
        return $result;
    }

    public function getAll($begin, $end, $limit)
    {
        $query = $this->model->with('site.user')
            ->where([['begin', $begin], ['end', $end]])
            ->orderBy('user_id');
        if ($limit == 0) {
            $result = $query->get();
        } else {
            $result = $query->paginate($limit);
        }
        return $result;
    }
}