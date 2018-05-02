<?php

namespace Adtech\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Adtech\Core\App\Models\PublisherCpcSiteDate;
use Illuminate\Support\Facades\DB;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('modules.core.dashboard.index');
    }

    public function home()
    {
        $startMonth = date('Y-m-01', strtotime("-3 month"));
        $endMonth = date('Y-m-t', strtotime("-3 month"));
        $startMonthCurrent = date('Y-m-01', strtotime("-2 month"));
        $endMonthCurrent = date('Y-m-t', strtotime("-2 month"));
        $yesterday = date('Y-m-d', strtotime($endMonthCurrent) - 86400);

        $allReport = PublisherCpcSiteDate::from('publisher_cpc_site_date as A')
            ->leftJoin('publisher.publisher_cpc_boxview_site_date AS BD', function ($join) {
                $join->on('BD.siteid', '=', 'A.siteid');
                $join->on('BD.dt', '=', 'A.dt');
            })
            ->select('A.siteid', 'BD.boxview', 'A.totalview', 'A.totalclick', 'A.realclick', 'A.dt', 'A.money', 'A.price')
            ->whereBetween('A.dt', [$startMonth, $endMonth])->get();

        $allReportCurrent = PublisherCpcSiteDate::from('publisher_cpc_site_date as A')
            ->leftJoin('publisher.publisher_cpc_boxview_site_date AS BD', function ($join) {
                $join->on('BD.siteid', '=', 'A.siteid');
                $join->on('BD.dt', '=', 'A.dt');
            })
            ->select('A.siteid', 'BD.boxview', 'A.totalview', 'A.totalclick', 'A.realclick', 'A.dt', 'A.money', 'A.price')
            ->whereBetween('A.dt', [$startMonthCurrent, $endMonthCurrent])->get();

        $total1 = 0;
        $total2 = 0;
        $total3 = 0;
        $total4 = 0;
        $total5 = 0;
        $total6 = 0;
        if (count($allReportCurrent) > 0) {
            foreach ($allReportCurrent as $report) {
                $total3 += $report->realclick;
                if ($report->dt == $endMonthCurrent) {
                    $total1 += $report->realclick;
                }
                if ($report->dt == $yesterday) {
                    $total2 += $report->realclick;
                }
            }
        }
        if (count($allReport) > 0) {
            foreach ($allReport as $report) {
                $total4 += $report->realclick;
                if ($report->dt == $yesterday) {
                    $total2 += $report->realclick;
                }
            }
        }

        $listSiteDK = DB::connection('mysql2')->table('reportingdb.publisher_site_tmp AS A')
            ->join('reportingdb.ox_users AS B', 'A.user_id', '=', 'B.user_id')
            ->select('A.*', 'B.username')
            ->where([
                ['A.auto_code', 1],
                ['A.site_active', 1],
//                ['A.status', 0]
            ])->limit(10)->get();
        $listSiteADX = DB::connection('mysql2')->table('publisher_request_product AS A')
            ->join('reportingdb.publisher_site AS B', 'A.siteid', '=', 'B.siteid')
            ->select('A.*', 'B.sitename')
            ->where([
                ['A.type', 7],
//                ['A.status', 0]
            ])->limit(10)->get();

        $data = [
            'total1' => $total1,
            'total2' => $total2,
            'total3' => $total3,
            'total4' => $total4,
            'listSiteDK' => json_encode($listSiteDK),
            'listSiteADX' => json_encode($listSiteADX),
        ];
        return view('modules.core.dashboard.home', $data);
    }
}
