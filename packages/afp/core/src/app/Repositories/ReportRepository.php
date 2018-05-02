<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

class ReportRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\Report';
    }

    public function getBySiteId($site_id, $begin, $end)
    {
        return $this->model
            ->select(DB::raw("SUM(totalclick) as totalclick, SUM(realclick) as realclick, 
            SUM(pageview) as pageview, SUM(impression) as impression, SUM(money) as money"))
            ->where('site_id', '=', $site_id)
            ->whereBetween('date', array($begin, $end))
            ->get();
    }

    public function getBySiteIdAll($site_id, $begin, $end)
    {
        return $this->model
            ->select(DB::raw("SUM(totalclick) as totalclick, SUM(realclick) as realclick, 
            SUM(pageview) as pageview, SUM(impression) as impression, SUM(money) as money, date"))
            ->where('site_id', '=', $site_id)
            ->whereBetween('date', array($begin, $end))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    public function getAllGroupBySite($begin, $end)
    {
        return $this->model->with('site')
            ->select(DB::raw("SUM(totalclick) as totalclick, SUM(realclick) as realclick,
            SUM(pageview) as pageview, SUM(impression) as impression, SUM(money) as money, site_id"))
            ->whereBetween('date', array($begin, $end))
            ->groupBy('site_id')
            ->get();
    }

    public function getBySiteIdByZone($site_id, $begin, $end)
    {
        return $this->model
            ->select(DB::raw("SUM(totalclick) as totalclick, SUM(realclick) as realclick,
            SUM(pageview) as pageview, SUM(impression) as impression, SUM(money) as money, zonecpc_id"))
            ->where('site_id', '=', $site_id)
            ->whereBetween('date', array($begin, $end))
            ->groupBy('zonecpc_id')
            ->get();
    }

    public function sumClickByDate($date)
    {
        return $this->model
            ->select(DB::raw("SUM(realclick) as realclick"))
            ->where('date', '=', $date)
            ->get();
    }

    public function sumClickByRange($begin, $end)
    {
        return $this->model
            ->select(DB::raw("SUM(realclick) as realclick"))
            ->whereBetween('date', array($begin, $end))
            ->get();
    }

    public function getAllBySite($site_id, $begin, $end)
    {
        return $this->model->with('site')
            ->select(DB::raw("SUM(totalclick) as totalclick, SUM(realclick) as realclick,
            SUM(pageview) as pageview, SUM(impression) as impression, SUM(money) as money, site_id"))
            ->whereBetween('date', array($begin, $end))
            ->where('site_id', '=', $site_id)
            ->groupBy('site_id')
            ->get();
    }

    public function getAll($begin, $end)
    {
        return $this->model
            ->select(DB::raw("SUM(totalclick) as totalclick, SUM(realclick) as realclick, date,
            SUM(pageview) as pageview, SUM(impression) as impression, SUM(money) as money"))
            ->whereBetween('date', array($begin, $end))
            ->groupBy('date')
            ->get();
    }
}