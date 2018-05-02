<?php

namespace Afp\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\ReportRepository;
use Afp\Core\App\Repositories\SiteRepository;
use Afp\Core\App\Repositories\SiteAdxRepository;
use Afp\Core\App\Repositories\SiteInfoRepository;
use Afp\Core\App\Repositories\SiteCategoryRespository;
use Afp\Core\App\Repositories\TagRepository;
use Adtech\Core\App\Repositories\UserRepository;
use Afp\Core\App\Repositories\ZoneCpcRepository;
use Validator;
use PHPExcel;
use PHPExcel_IOFactory;

class ReportController extends Controller
{
    /**
     * @var SiteCategoryRespository
     * @var SiteRepository
     * @var SiteInfoRepository
     * @var SiteAdxRepository
     * @var TagRepository
     * @var UserRepository
     * @var ReportRepository
     * @var ZoneCpcRepository
     */
    private $siteCategoryRepository;
    private $siteRepository;
    private $siteAdxRepository;
    private $siteInfoRepository;
    private $tagRepository;
    private $userRepository;
    private $reportRepository;
    private $zoneCpcRepository;

    public function __construct(SiteCategoryRespository $siteCategoryRepository,
                                SiteRepository $siteRepository,
                                SiteAdxRepository $siteAdxRepository,
                                SiteInfoRepository $siteInfoRepository,
                                UserRepository $userRepository,
                                ReportRepository $reportRepository,
                                ZoneCpcRepository $zoneCpcRepository,
                                TagRepository $tagRepository)
    {
        parent::__construct();
        $this->siteCategory = $siteCategoryRepository;
        $this->siteInfo = $siteInfoRepository;
        $this->siteAdx = $siteAdxRepository;
        $this->site = $siteRepository;
        $this->report = $reportRepository;
        $this->user = $userRepository;
        $this->tag = $tagRepository;
        $this->zoneCpc = $zoneCpcRepository;
    }

    public function manage(Request $request)
    {
//        $arrData = [
//            1 => [
//                'site_id'   => 8,
//                'zonecpc_id'   => rand(1,4)
//            ],
//            2 => [
//                'site_id'   => 25,
//                'zonecpc_id'   => rand(5,6)
//            ],
//            3 => [
//                'site_id'   => 26,
//                'zonecpc_id'   => rand(7,8)
//            ]
//        ];
//        for($i=0; $i<10; $i++){
//            $numrand = rand(1,3);
//            $dataInsert[] = [
//                'zonecpc_id'=>$arrData[$numrand]['zonecpc_id'],
//                'site_id'=>$arrData[$numrand]['site_id'],
//                'totalclick'=>rand(10000,99999),
//                'realclick'=>rand(10000,99999),
//                'pageview'=>rand(100000,999999),
//                'impression'=>rand(100000,999999),
//                'date'=>date('Y-m-01'),
//                'money'=>rand(100000,999999),
//                'price'=>rand(100,900)
//            ];
//        }
//        DB::table('afp_report')->insert($dataInsert);

        $keyword = trim($request->input('keyword', ''));
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);
        $category = (int)$request->input('category', 0);
        $status = (int)$request->input('status', 0);
        $tag = (int)$request->input('tag', 0);
        $begin = $request->input('begin', date('Y-m-d'));
        $end = $request->input('end', date('Y-m-d'));

        $statusList = [0 => ['id' => 1, 'name' => 'off'], 1 => ['id' => 2, 'name' => 'on']];
        $siteList = $siteEmpty = [];

        $total = $this->site->countAll($keyword, $status, $category, $tag, 2);
        $siteData = $this->site->findAll($keyword, $limit, $status, $category, $tag, 2);
        if ($siteData && count($siteData) > 0) {
            foreach ($siteData as $k => $site) {
                $dataSite = $this->report->getBySiteId($site->site_id, $begin, $end);
                if (null != $dataSite) {
                    $totalclick = ($dataSite[0]->totalclick > 0) ? $dataSite[0]->totalclick : 0;
                    $realclick = ($dataSite[0]->realclick > 0) ? $dataSite[0]->realclick : 0;
                    $clickao = ($totalclick > 0) ? round((($totalclick - $realclick) / $totalclick * 100), 2) . '%' : '<i>N/A</i>';
                    $pageview = ($dataSite[0]->pageview > 0) ? $dataSite[0]->pageview : 0;
                    $impression = ($dataSite[0]->impression > 0) ? $dataSite[0]->impression : 0;
                    $ctr = ($pageview > 0) ? round(($realclick / $pageview * 100), 2) . '%' : '<i>N/A</i>';
                    $money = ($dataSite[0]->money > 0) ? $dataSite[0]->money : 0;
                }
                $siteList[] = [
                    'id' => $site->site_id,
                    'site_id' => $site->site_id,
                    'sitename' => $site->sitename,
                    'totalclick' => ($totalclick > 0) ? number_format($totalclick) : '<i>N/A</i>',
                    'realclick' => ($realclick > 0) ? number_format($realclick) : '<i>N/A</i>',
                    'clickao' => $clickao,
                    'pageview' => ($pageview > 0) ? number_format($pageview) : '<i>N/A</i>',
                    'impression' => ($impression > 0) ? number_format($impression) : '<i>N/A</i>',
                    'money' => ($money > 0) ? number_format($money) : '<i>N/A</i>',
                    'ctr' => $ctr,
                    'price_sale' => ($site->info->price_sale > 0) ? number_format($site->info->price_sale) : '<i>N/A</i>',
                    'price_buy' => ($site->info->price_buy > 0) ? number_format($site->info->price_buy) : '<i>N/A</i>',
                    'reportDetail' => route('afp.core.report.detail', [
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
        $categoryList = $this->siteCategory->findAll('status', 1);
        $tagList = $this->tag->findAll('status', 1);
        $data = [
            'jsonSiteEmptyString' => json_encode($siteEmpty),
            'jsonSiteString' => json_encode($siteList),
            'categoryList' => json_encode($categoryList),
            'tagList' => json_encode($tagList),
            'pageIndex' => $pageIndex,
            'keyword' => $keyword,
            'limit' => $limit,
            'status' => $status,
            'tag' => $tag,
            'category' => $category,
            'total' => $total,
            'begin' => $begin,
            'end' => $end,
            'statusList' => json_encode($statusList)
        ];
        return view('modules.core.report.manage', $data);
    }

    public function exportSite(Request $request)
    {
        $keyword = trim($request->input('keyword', ''));
        $category = (int)$request->input('category', 0);
        $status = (int)$request->input('status', 0);
        $tag = (int)$request->input('tag', 0);
        $begin = $request->input('begin', date('Y-m-d'));
        $end = $request->input('end', date('Y-m-d'));

        $siteData = $this->site->findAllExport($keyword, $status, $category, $tag, 2);
        if ($siteData && count($siteData) > 0) {

            $filename = public_path() . '/files/report-site-' . $begin . '--' . $end . '.xls';
            $filedownload = config('app.url') . '/files/report-site-' . $begin . '--' . $end . '.xls';

            // Create new PHPExcel object
            if (file_exists($filename)) {
                unlink($filename);
            }
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setCreator("Electric")
                ->setLastModifiedBy("Electric")
                ->setTitle("Báo cáo hiệu suất " . $begin . '--' . $end)
                ->setSubject("Báo cáo hiệu suất " . $begin . '--' . $end)
                ->setDescription("Báo cáo hiệu suất " . $begin . '--' . $end)
                ->setKeywords("Báo cáo hiệu suất " . $begin . '--' . $end)
                ->setCategory("Báo cáo hiệu suất " . $begin . '--' . $end);

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'STT')
                ->setCellValue('B1', 'Sitename')
                ->setCellValue('C1', 'Total Click')
                ->setCellValue('D1', 'Real Click')
                ->setCellValue('E1', '% Click ảo')
                ->setCellValue('F1', 'Page View')
                ->setCellValue('G1', 'Impression')
                ->setCellValue('H1', '% CTR')
                ->setCellValue('I1', 'Giá bán')
                ->setCellValue('J1', 'Giá mua')
                ->setCellValue('K1', 'Doanh thu');

            $stt = 2;
            foreach ($siteData as $k => $site) {
                $dataSite = $this->report->getBySiteId($site->site_id, $begin, $end);
                if (null != $dataSite) {
                    $totalclick = ($dataSite[0]->totalclick > 0) ? $dataSite[0]->totalclick : 0;
                    $realclick = ($dataSite[0]->realclick > 0) ? $dataSite[0]->realclick : 0;
                    $clickao = ($totalclick > 0) ? round((($totalclick - $realclick) / $totalclick * 100), 2) . '%' : 0;
                    $pageview = ($dataSite[0]->pageview > 0) ? $dataSite[0]->pageview : 0;
                    $impression = ($dataSite[0]->impression > 0) ? $dataSite[0]->impression : 0;
                    $ctr = ($pageview > 0) ? round(($realclick / $pageview * 100), 2) . '%' : 0;
                    $money = ($dataSite[0]->money > 0) ? $dataSite[0]->money : 0;
                }

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $stt, $stt)
                    ->setCellValue('B' . $stt, $site->sitename)
                    ->setCellValue('C' . $stt, $totalclick)
                    ->setCellValue('D' . $stt, $realclick)
                    ->setCellValue('E' . $stt, $clickao)
                    ->setCellValue('F' . $stt, $pageview)
                    ->setCellValue('G' . $stt, $impression)
                    ->setCellValue('H' . $stt, $ctr)
                    ->setCellValue('I' . $stt, $site->info->price_sale)
                    ->setCellValue('J' . $stt, $site->info->price_buy)
                    ->setCellValue('K' . $stt, $money);
                $stt++;

            }
            // Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle("Báo cáo hiệu suất");
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save($filename);

            $response = array(
                'success' => true,
                'url' => $filedownload
            );
            return $response;
        }

        $response = array(
            'success' => false,
            'url' => ''
        );
        return $response;
    }

    public function exportZone(Request $request)
    {
        $keyword = trim($request->input('keyword', ''));
        $category = (int)$request->input('category', 0);
        $status = (int)$request->input('status', 0);
        $tag = (int)$request->input('tag', 0);
        $begin = $request->input('begin', date('Y-m-d'));
        $end = $request->input('end', date('Y-m-d'));

        $siteData = $this->site->findAllExport($keyword, $status, $category, $tag, 2);
        if ($siteData && count($siteData) > 0) {

            $filename = public_path() . '/files/report-zone-' . $begin . '--' . $end . '.xls';
            $filedownload = config('app.url') . '/files/report-zone-' . $begin . '--' . $end . '.xls';

            // Create new PHPExcel object
            if (file_exists($filename)) {
                unlink($filename);
            }
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setCreator("Electric")
                ->setLastModifiedBy("Electric")
                ->setTitle("Báo cáo hiệu suất " . $begin . '--' . $end)
                ->setSubject("Báo cáo hiệu suất " . $begin . '--' . $end)
                ->setDescription("Báo cáo hiệu suất " . $begin . '--' . $end)
                ->setKeywords("Báo cáo hiệu suất " . $begin . '--' . $end)
                ->setCategory("Báo cáo hiệu suất " . $begin . '--' . $end);

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'STT')
                ->setCellValue('B1', 'Sitename')
                ->setCellValue('C1', 'Zonename')
                ->setCellValue('D1', 'Total Click')
                ->setCellValue('E1', 'Real Click')
                ->setCellValue('F1', '% Click ảo')
                ->setCellValue('G1', 'Page View')
                ->setCellValue('H1', 'Impression')
                ->setCellValue('I1', '% CTR')
                ->setCellValue('J1', 'Giá bán')
                ->setCellValue('K1', 'Giá mua')
                ->setCellValue('L1', 'Doanh thu');

            $stt = 2;
            foreach ($siteData as $k => $site) {
                $dataSite = $this->report->getBySiteIdByZone($site->site_id, $begin, $end);
                if (null != $dataSite && count($dataSite) > 0) {
                    foreach ($dataSite as $item) {
                        $totalclick = ($item->totalclick > 0) ? $item->totalclick : 0;
                        $realclick = ($item->realclick > 0) ? $item->realclick : 0;
                        $clickao = ($totalclick > 0) ? round((($totalclick - $realclick) / $totalclick * 100), 2) . '%' : 0;
                        $pageview = ($item->pageview > 0) ? $item->pageview : 0;
                        $impression = ($item->impression > 0) ? $item->impression : 0;
                        $ctr = ($pageview > 0) ? round(($realclick / $pageview * 100), 2) . '%' : 0;
                        $money = ($item->money > 0) ? $item->money : 0;
                        $zone_name = $this->zoneCpc->findID($item->zonecpc_id)->name;

                        $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $stt, $stt)
                            ->setCellValue('B' . $stt, $site->sitename)
                            ->setCellValue('C' . $stt, $zone_name)
                            ->setCellValue('D' . $stt, $totalclick)
                            ->setCellValue('E' . $stt, $realclick)
                            ->setCellValue('F' . $stt, $clickao)
                            ->setCellValue('G' . $stt, $pageview)
                            ->setCellValue('H' . $stt, $impression)
                            ->setCellValue('I' . $stt, $ctr)
                            ->setCellValue('J' . $stt, $site->info->price_sale)
                            ->setCellValue('K' . $stt, $site->info->price_buy)
                            ->setCellValue('L' . $stt, $money);
                        $stt++;
                    }
                }
            }
            // Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle("Báo cáo hiệu suất");
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save($filename);

            $response = array(
                'success' => true,
                'url' => $filedownload
            );
            return $response;
        }

        $response = array(
            'success' => false,
            'url' => ''
        );
        return $response;
    }

    //
    public function detail(Request $request, $site_id)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);
        $begin = $request->input('begin', date('Y-m-d'));
        $end = $request->input('end', date('Y-m-d'));

        $siteList = $siteListZone = $siteEmpty = $siteEmptyZone = $siteListTotal = [];
        $dataMoney = $dataImp = $dataClick = $xData = $siteZoneTotal = [];
        $arrMoney = $arrImpression = $arrClick = [];
        $arrTotal = $arrTotalZone = [];
        $charData = ['xData' => null, 'datasets' => [
            [
                'name' => 'Thanh toán',
                'data' => null,
                'unit' => 'vnd',
                'type' => 'line',
                'valueDecimals' => 0,
                'pointStart' => date_default_timezone_get()
            ], [
                'name' => 'Impression',
                'data' => null,
                'unit' => 'imp',
                'type' => 'line',
                'valueDecimals' => 0,
                'pointStart' => date_default_timezone_get()
            ], [
                'name' => 'Clicks',
                'data' => null,
                'unit' => 'click',
                'type' => 'line',
                'valueDecimals' => 0,
                'pointStart' => date_default_timezone_get()
            ]
        ]];
        $total = 0;

        $arrTotal['totalclick'] = 0;
        $arrTotal['realclick'] = 0;
        $arrTotal['pageview'] = 0;
        $arrTotal['impression'] = 0;
        $arrTotal['money'] = 0;

        $arrTotalZone['totalclick'] = 0;
        $arrTotalZone['realclick'] = 0;
        $arrTotalZone['pageview'] = 0;
        $arrTotalZone['impression'] = 0;
        $arrTotalZone['money'] = 0;

        $beginTime = strtotime($begin);
        $endTime = strtotime($end);
        for ($i = $beginTime; $i <= $endTime; $i = $i + 86400) {
            $thisDate = date('Y-m-d', $i);
            $arrMoney[$thisDate] = 0;
            $arrImpression[$thisDate] = 0;
            $arrClick[$thisDate] = 0;
            $xData[] = date('d/m', $i);
        }

        $siteDetail = $this->site->findID($site_id);
        if (null != $siteDetail) {
            $dataSite = $this->report->getBySiteIdAll($site_id, $begin, $end);
            if (null != $dataSite && count($dataSite) > 0) {
                $total = count($dataSite);
                foreach ($dataSite as $item) {
                    $totalclick = ($item->totalclick > 0) ? $item->totalclick : 0;
                    $realclick = ($item->realclick > 0) ? $item->realclick : 0;
                    $clickao = ($totalclick > 0) ? round((($totalclick - $realclick) / $totalclick * 100), 2) . '%' : 0;
                    $pageview = ($item->pageview > 0) ? $item->pageview : 0;
                    $impression = ($item->impression > 0) ? $item->impression : 0;
                    $ctr = ($pageview > 0) ? round(($realclick / $pageview * 100), 2) . '%' : 0;
                    $money = ($item->money > 0) ? $item->money : 0;
                    $date = date('d/m/Y', strtotime($item->date));

                    $arrTotal['totalclick'] += $totalclick;
                    $arrTotal['realclick'] += $realclick;
                    $arrTotal['pageview'] += $pageview;
                    $arrTotal['impression'] += $impression;
                    $arrTotal['money'] += $money;

                    $arrMoney[$item->date] = (int)$money;
                    $arrImpression[$item->date] = (int)$impression;
                    $arrClick[$item->date] = (int)$realclick;

                    $siteList[] = [
                        'date' => $date,
                        'site_id' => $siteDetail->site_id,
                        'sitename' => $siteDetail->sitename,
                        'totalclick' => $totalclick,
                        'realclick' => $realclick,
                        'clickao' => $clickao,
                        'pageview' => $pageview,
                        'impression' => $impression,
                        'money' => $money,
                        'ctr' => $ctr,
                        'price_sale' => $siteDetail->info->price_sale,
                        'price_buy' => $siteDetail->info->price_buy
                    ];
                }
                $arrTotal['clickao'] = ($arrTotal['totalclick'] > 0) ? round((($arrTotal['totalclick'] - $arrTotal['realclick']) / $arrTotal['totalclick'] * 100), 2) . '%' : 0;
                $arrTotal['ctr'] = ($arrTotal['pageview'] > 0) ? round(($arrTotal['realclick'] / $arrTotal['pageview'] * 100), 2) . '%' : 0;
                $siteListTotal[] = [
                    'date' => 'Tổng',
                    'totalclick' => $arrTotal['totalclick'],
                    'realclick' => $arrTotal['realclick'],
                    'clickao' => $arrTotal['clickao'],
                    'pageview' => $arrTotal['pageview'],
                    'impression' => $arrTotal['impression'],
                    'money' => $arrTotal['money'],
                    'ctr' => $arrTotal['ctr'],
                    'price_sale' => '-',
                    'price_buy' => '-'
                ];
            }

            $dataMoney = array_values($arrMoney);
            $dataImp = array_values($arrImpression);
            $dataClick = array_values($arrClick);

            $charData['datasets'][0]['data'] = $dataMoney;
            $charData['datasets'][1]['data'] = $dataImp;
            $charData['datasets'][2]['data'] = $dataClick;

            $dataSite = $this->report->getBySiteIdByZone($site_id, $begin, $end);
            if (null != $dataSite && count($dataSite) > 0) {
                $total = count($dataSite);
                foreach ($dataSite as $item) {
                    $totalclick = ($item->totalclick > 0) ? $item->totalclick : 0;
                    $realclick = ($item->realclick > 0) ? $item->realclick : 0;
                    $clickao = ($totalclick > 0) ? round((($totalclick - $realclick) / $totalclick * 100), 2) . '%' : 0;
                    $pageview = ($item->pageview > 0) ? $item->pageview : 0;
                    $impression = ($item->impression > 0) ? $item->impression : 0;
                    $ctr = ($pageview > 0) ? round(($realclick / $pageview * 100), 2) . '%' : 0;
                    $money = ($item->money > 0) ? $item->money : 0;
                    $date = date('d-m-Y', strtotime($item->date));
                    $zone_name = $this->zoneCpc->findID($item->zonecpc_id)->name;

                    $arrTotalZone['totalclick'] += $totalclick;
                    $arrTotalZone['realclick'] += $realclick;
                    $arrTotalZone['pageview'] += $pageview;
                    $arrTotalZone['impression'] += $impression;
                    $arrTotalZone['money'] += $money;

                    $siteListZone[] = [
                        'zone_name' => $zone_name,
                        'site_id' => $siteDetail->site_id,
                        'sitename' => $siteDetail->sitename,
                        'totalclick' => $totalclick,
                        'realclick' => $realclick,
                        'clickao' => $clickao,
                        'pageview' => $pageview,
                        'impression' => $impression,
                        'money' => $money,
                        'ctr' => $ctr,
                        'price_sale' => $siteDetail->info->price_sale,
                        'price_buy' => $siteDetail->info->price_buy
                    ];
                }
                $arrTotalZone['clickao'] = ($arrTotalZone['totalclick'] > 0) ? round((($arrTotalZone['totalclick'] - $arrTotalZone['realclick']) / $arrTotalZone['totalclick'] * 100), 2) . '%' : 0;
                $arrTotalZone['ctr'] = ($arrTotalZone['pageview'] > 0) ? round(($arrTotalZone['realclick'] / $arrTotalZone['pageview'] * 100), 2) . '%' : 0;
                $siteZoneTotal[] = [
                    'zone_name' => 'Tổng',
                    'totalclick' => $arrTotalZone['totalclick'],
                    'realclick' => $arrTotalZone['realclick'],
                    'clickao' => $arrTotalZone['clickao'],
                    'pageview' => $arrTotalZone['pageview'],
                    'impression' => $arrTotalZone['impression'],
                    'money' => $arrTotalZone['money'],
                    'ctr' => $arrTotalZone['ctr'],
                    'price_sale' => '-',
                    'price_buy' => '-'
                ];
            }
        }

        if (count($siteList) == 0) {
            $siteEmpty[] = [
                'name' => trans('afp-core::labels.empty')
            ];
        }
        if (count($siteListZone) == 0) {
            $siteEmptyZone[] = [
                'name' => trans('afp-core::labels.empty')
            ];
        }

        $charData['xData'] = $xData;
        $categoryList = $this->siteCategory->findAll('status', 1);
        $tagList = $this->tag->findAll('status', 1);
        $data = [
            'jsonSiteEmptyString' => json_encode($siteEmpty),
            'jsonSiteZoneEmptyString' => json_encode($siteEmptyZone),
            'jsonSiteString' => json_encode($siteList),
            'jsonSiteZoneString' => json_encode($siteListZone),
            'jsonSiteZoneTotal' => json_encode($siteZoneTotal),
            'jsonSiteListTotal' => json_encode($siteListTotal),
            'xData' => json_encode($xData),
            'dataMoney' => json_encode($dataMoney),
            'dataImp' => json_encode($dataImp),
            'dataClick' => json_encode($dataClick),
            'charData' => json_encode($charData),
            'pageIndex' => $pageIndex,
            'limit' => $limit,
            'total' => $total,
            'site_id' => $site_id,
            'begin' => $begin,
            'end' => $end
        ];
        return view('modules.core.report.detail', $data);
    }
}
