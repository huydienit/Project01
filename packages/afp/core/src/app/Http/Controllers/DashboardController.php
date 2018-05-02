<?php

namespace Afp\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\SiteCategoryRespository;
use Afp\Core\App\Repositories\ReportRepository;
use Afp\Core\App\Repositories\SiteRepository;
use Afp\Core\App\Repositories\SiteInfoRepository;
use Afp\Core\App\Repositories\TagRepository;
use Illuminate\Support\Facades\DB;
use Auth;

class DashboardController extends Controller
{
    /**
     * @var SiteCategoryRespository
     * @var SiteRepository
     * @var ReportRepository
     * @var SiteInfoRepository
     * @var TagRepository
     */
    private $siteCategoryRepository;
    private $siteRepository;
    private $reportRepository;
    private $siteInfoRepository;
    private $tagRepository;

    public function __construct(TagRepository $tagRepository,
                                SiteRepository $siteRepository,
                                ReportRepository $reportRepository,
                                SiteInfoRepository $siteInfoRepository,
                                SiteCategoryRespository $siteCategoryRepository)
    {
        parent::__construct();
        $this->tag = $tagRepository;
        $this->site = $siteRepository;
        $this->report = $reportRepository;
        $this->siteInfo = $siteInfoRepository;
        $this->siteCategory = $siteCategoryRepository;
    }

    public function intro()
    {
        return view('modules.core.dashboard.index');
    }

    public function index()
    {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime("-1 days"));

        $end = date('Y-m-d');
        $begin = date('Y-m-d', strtotime("-7 days"));

        $startMonth = date("Y-m-d", strtotime("first day of previous month"));
        $endMonth = date("Y-m-d", strtotime("last day of previous month"));
        $startMonthCurrent = date('Y-m-01');
        $endMonthCurrent = date('Y-m-t');

        $today = $this->report->sumClickByDate($today);
        $total1 = (null != $today[0]->realclick) ? $today[0]->realclick : 0;

        $yesterday = $this->report->sumClickByDate($yesterday);
        $total2 = (null != $yesterday[0]->realclick) ? $yesterday[0]->realclick : 0;

        $thismonth = $this->report->sumClickByRange($startMonthCurrent, $endMonthCurrent);
        $total3 = (null != $thismonth[0]->realclick) ? $thismonth[0]->realclick : 0;

        $lastmonth = $this->report->sumClickByRange($startMonth, $endMonth);
        $total4 = (null != $lastmonth[0]->realclick) ? $lastmonth[0]->realclick : 0;

        $limit = 4; $status = 3; $total = $category = $tag = 0;
        $siteList = $siteEmpty = $siteData = []; $keyword = '';

        $total = $this->site->countAll($keyword, $status, $category, $tag);
        $siteData = $this->site->findAll($keyword, $limit, $status, $category, $tag);
        if ($siteData && count($siteData) > 0) {
            foreach ($siteData as $k => $site) {
                $siteList[] = [
                    'id' => $site->site_id,
                    'site_id' => $site->site_id,
                    'sitename' => $site->sitename,
                    'username' => $site->user->username,
                    'price_sale' => $site->info->price_sale,
                    'visits' => $site->info->visits,
                    'pageviews' => $site->info->pageviews,
                    'type' => 1,
                    'site_status' => $site->info->site_status,
                    'statusLB' => ($site->info->site_status == 1) ? true : false,
                    'zonedetailurl' => route('afp.core.zone-cpc.manage', [
                        'site_id' => $site->site_id,
                    ])
                ];
            }
        }
        if (count($siteList) == 0) {
            $siteEmpty[] = [
                'name' => trans('afp-core::labels.empty')
            ];
        }

        $tagList = $this->tag->findAll('status', 1);
        $categoryList = $this->siteCategory->findAll('status', 1);
        $categories = $chartData = $arrMoney = $arrImpression = $arrClick = [];
        for ( $i = strtotime($begin); $i <= strtotime($end); $i = $i + 86400 ) {
            $date = date( 'd/m', $i );
            $categories[] = $date;
            $arrMoney[$date] = 0;
            $arrImpression[$date] = 0;
            $arrClick[$date] = 0;
        }

        $dataReport = $this->report->getAll($begin, $end);
        if (null != $dataReport)
        {
            foreach($dataReport as $item)
            {
                $realclick = ($item->realclick > 0) ? $item->realclick : 0;
                $impression = ($item->impression > 0) ? $item->impression : 0;
                $money = ($item->money > 0) ? $item->money : 0;

                $date = date( 'd/m', strtotime($item->date) );
                $arrMoney[$date] = (int)$money;
                $arrImpression[$date] = (int)$impression;
                $arrClick[$date] = (int)$realclick;
            }
        }

        $chartData = [
            [
                'type'  => 'column',
                'name'  => 'Thanh toán',
                'data'  => array_values($arrMoney)
            ],[
                'type'  => 'spline',
                'name'  => 'Impression',
                'data'  => array_values($arrImpression)
            ],[
                'type'  => 'spline',
                'name'  => 'Click',
                'data'  => array_values($arrClick)
            ]
        ];
        $data = [
            'total1' => $total1,
            'total2' => $total2,
            'total3' => $total3,
            'total4' => $total4,
            'total' => $total,
            'limit' => $limit,
            'tagList' => json_encode($tagList),
            'categoryList' => json_encode($categoryList),
            'categories' => json_encode($categories),
            'chartData' => json_encode($chartData),
            'listSiteDK' => json_encode($siteList),
            'listSiteEmpty' => json_encode($siteEmpty)
        ];
        return view('modules.core.dashboard.home', $data);
    }

    public function getsitedk(Request $request)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 4);
        $siteList = $siteEmpty = [];
        $total = $this->site->countAll('', 3, 0, 0);
        $siteData = $this->site->findAll('', $limit, 3, 0, 0);
        if ($siteData && count($siteData) > 0) {
            foreach ($siteData as $k => $site) {
                $siteList[] = [
                    'id' => $site->site_id,
                    'site_id' => $site->site_id,
                    'sitename' => $site->sitename,
                    'username' => $site->user->username,
                    'price_sale' => $site->info->price_sale,
                    'visits' => $site->info->visits,
                    'pageviews' => $site->info->pageviews,
                    'type' => 1,
                    'site_status' => $site->info->site_status,
                    'statusLB' => ($site->info->site_status == 1) ? true : false,
                    'zonedetailurl' => route('afp.core.zone-cpc.manage', [
                        'site_id' => $site->site_id,
                    ])
                ];
            }
        }
        if (count($siteList) == 0) {
            $siteEmpty[] = [
                'name' => trans('afp-core::labels.empty')
            ];
        }
        return json_encode($siteList);
    }
}

