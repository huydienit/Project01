<?php

namespace Afp\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\ReportRepository;
use Afp\Core\App\Repositories\PaymentRepository;
use Afp\Core\App\Repositories\UserInfoRepository;
use Afp\Core\App\Repositories\SiteInfoRepository;
use Afp\Core\App\Repositories\SiteRepository;
use Afp\Core\App\Repositories\PaymentMailRepository;
use Afp\Core\App\Models\Payment;
use Validator;
use App;
use Mail;
use PHPExcel;
use PHPExcel_IOFactory;

class PaymentController extends Controller
{
    /**
     * @var ReportRepository
     * @var PaymentRepository
     * @var UserInfoRepository
     * @var SiteInfoRepository
     * @var PaymentMailRepository
     * @var SiteRepository
     */
    private $reportRepository;
    private $paymentRepository;
    private $userInfoRepository;
    private $siteInfoRepository;
    private $siteRepository;
    private $paymentmailRepository;

    public function __construct(ReportRepository $reportRepository,
                                PaymentRepository $paymentRepository,
                                UserInfoRepository $userInfoRepository,
                                SiteInfoRepository $siteInfoRepository,
                                PaymentMailRepository $paymentmailRepository,
                                SiteRepository $siteRepository)
    {
        parent::__construct();
        $this->report = $reportRepository;
        $this->payment = $paymentRepository;
        $this->userInfo = $userInfoRepository;
        $this->siteInfo = $siteInfoRepository;
        $this->paymentMail = $paymentmailRepository;
        $this->site = $siteRepository;
    }

    public function manage(Request $request)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);
        $month = $request->input('month', "first day of previous month");

        $monthFilter = date('m', strtotime($month));
        $yearFilter = date('Y', strtotime($month));

        $begin = date('Y-m-01', strtotime($month));
        $end = date('Y-m-t', strtotime($month));

        $siteList = $siteEmpty = [];
        $monthList = $yearList = [];
        for ($i = 1; $i < 13; $i++) {
            $monthList[] = [
                'id' => $i,
                'name' => 'Tháng ' . $i
            ];
            $year = date('Y');
            $yearList[] = [
                'id' => $year - $i + 1,
                'name' => $year - $i + 1
            ];
        }

        $total = $this->payment->countAll($begin, $end);
        $siteData = $this->payment->getAll($begin, $end, $limit);

        if ($siteData && count($siteData) > 0) {
            foreach ($siteData as $k => $site) {
                $siteList[] = [
                    'id' => $site->site_id,
                    'site_id' => $site->site_id,
                    'sitename' => $site->site->sitename,
                    'money' => $site->money,
                    'sotien' => 0,
                    'note' => $site->note,
                    'note_pub' => $site->note_pub,
                    'status' => ($site->status == 1) ? 'Đã thanh toán' : 'Chưa thanh toán',
                    'thoigian' => $site->begin . ' -> ' . $site->end,
                    'begin' => $site->begin,
                    'end' => $site->end,
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

        $data = [
            'jsonSiteEmptyString' => json_encode($siteEmpty),
            'jsonSiteString' => json_encode($siteList),
            'pageIndex' => $pageIndex,
            'limit' => $limit,
            'total' => $total,
//            'month' => $monthStr,
            'monthFilter' => $monthFilter,
            'yearFilter' => $yearFilter,
            'monthList' => json_encode($monthList),
            'yearList' => json_encode($yearList)
        ];

        return view('modules.core.payment.manage', $data);
    }

    public function sync(Request $request)
    {
        $month = $request->input('month', "-1 month");
        $begin = date('Y-m-01', strtotime($month));
        $end = date('Y-m-t', strtotime($month));
        $timepick = date('Y-m', strtotime($month));
        $filename = public_path() . '/files/' . $begin . '--' . $end . '.xls';

        $dataInsert = [];
        $reportList = $this->report->getAllGroupBySite($begin, $end);
        if (null != $reportList && count($reportList) > 0) {
            foreach ($reportList as $k => $report) {
                $paymentDetail = $this->payment
                    ->findWhere([['site_id', $report->site_id], ['begin', $begin], ['end', $end]])
                    ->first();
                if (null == $paymentDetail) {
                    $dataInsert[] = [
                        'user_id' => $report->site->user_id,
                        'site_id' => $report->site_id,
                        'begin' => $begin,
                        'end' => $end,
                        'money' => $report->money,
                        'status' => 0,
                    ];
                }
            }
            Payment::insert($dataInsert);
            $this->exportExcel($request);

            //Lay danh sach mail can gui CC
            $arrCC = $arrBcc = [];
            $dataCC = $this->paymentMail->findAll('type', 1);
            if (count($dataCC) > 0) {
                foreach ($dataCC as $key => $item) {
                    $arrCC[] = $item->email;
                }
            }
            //Lay danh sach mail can gui Bcc
            $dataBcc = $this->paymentMail->findAll('type', 2);
            if (count($dataBcc) > 0) {
                foreach ($dataBcc as $key => $item) {
                    $arrBcc[] = $item->email;
                }
            }

            Mail::send(['html' => 'modules.core.mail.payment'], [], function ($message) use ($filename, $timepick, $arrCC, $arrBcc) {
                $message
                    ->to('huydien.it@gmail.com', 'Admin')
                    ->cc($arrCC)
                    ->bcc($arrBcc)
                    ->subject('Thông báo chốt doanh thu tháng ' . $timepick)
                    ->attach($filename);
            });
        }
    }

    public function upload()
    {
        $mimes = array('application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv');
        if (in_array($_FILES["file"]["type"], $mimes)) {
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $image = time() . '.' . $ext;
            $destinationPath = public_path('payment/');
            $filename = $destinationPath . $image;
            move_uploaded_file($_FILES["file"]["tmp_name"], $filename);

            $objPHPExcel = PHPExcel_IOFactory::load($filename);
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10

                for ($row = 2; $row <= $highestRow; ++$row) {
                    $sitename = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $time = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $status = self::slugify($worksheet->getCellByColumnAndRow(14, $row)->getValue());
                    $note = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                    $note_pub = $worksheet->getCellByColumnAndRow(16, $row)->getValue();

                    $siteDetail = $this->site->getBySite($sitename);
                    if (null != $siteDetail) {
                        $begin = substr($time, 0, 10);
                        $end = substr($time, -10);
                        $site_id = $siteDetail->site_id;
                        $status = ($status == 'thanh-ton') ? 1 : 0;

                        Payment::where([
                            ['site_id', $site_id],
                            ['begin', $begin],
                            ['end', $end]
                        ])->update(['status' => $status, 'note' => $note, 'note_pub' => $note_pub]);
                    }
                }
            }
        } else {
            echo "File Is Empty";
        }
    }

    public function exportExcel(Request $request)
    {
        $month = $request->input('month', "-1 month");
        $begin = date('Y-m-01', strtotime($month));
        $end = date('Y-m-t', strtotime($month));
        $siteList = [];
        $sttCol = 2;
        $filename = public_path() . '/files/' . $begin . '--' . $end . '.xls';
        $filedownload = config('app.url') . '/files/' . $begin . '--' . $end . '.xls';

        // Create new PHPExcel object
        if (file_exists($filename)) {
            unlink($filename);
        }
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Electric")
            ->setLastModifiedBy("Electric")
            ->setTitle("Báo cáo dư nợ " . $begin . '--' . $end)
            ->setSubject("Báo cáo dư nợ " . $begin . '--' . $end)
            ->setDescription("Báo cáo dư nợ " . $begin . '--' . $end)
            ->setKeywords("Báo cáo dư nợ " . $begin . '--' . $end)
            ->setCategory("Báo cáo dư nợ " . $begin . '--' . $end);


        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'STT')
            ->setCellValue('B1', 'Tên tài khoản')
            ->setCellValue('C1', 'Tên khách hàng')
            ->setCellValue('D1', 'Website')
            ->setCellValue('E1', 'Thời gian tính doanh thu')
            ->setCellValue('F1', 'Click')
            ->setCellValue('G1', 'Đơn giá')
            ->setCellValue('H1', 'Tổng tiền')
            ->setCellValue('I1', 'Thực trả')
            ->setCellValue('J1', 'Số tài khoản')
            ->setCellValue('K1', 'Ngân hàng - Chi nhánh')
            ->setCellValue('L1', 'Mã số thuế')
            ->setCellValue('M1', 'Số CMND')
            ->setCellValue('N1', 'Địa chỉ')
            ->setCellValue('O1', 'Trạng thái')
            ->setCellValue('P1', 'Ghi chú - Kế toán')
            ->setCellValue('Q1', 'Ghi chú - Publisher');

        $stt = 2;
        $siteData = $this->payment->getAll($begin, $end, 0);
        if ($siteData && count($siteData) > 0) {
            foreach ($siteData as $k => $site) {
                if ($site->money >= 200000) {
                    $old_user_id = $site->site->user_id;
                    $userInfo = $this->userInfo->find($site->site->user_id);
                    $siteInfo = $this->siteInfo->find($site->site_id);
                    $report = $this->report->getAllBySite($site->site_id, $begin, $end);

                    if ($old_user_id != $site->site->user_id || ($k + 1) == count($siteData)) {
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B' . $sttCol . ':B' . $stt);
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . $sttCol . ':C' . $stt);
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('J' . $sttCol . ':J' . $stt);
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K' . $sttCol . ':K' . $stt);
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('L' . $sttCol . ':L' . $stt);
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('M' . $sttCol . ':M' . $stt);
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('N' . $sttCol . ':N' . $stt);
                        $sttCol = $stt;
                    }

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $stt, $stt)
                        ->setCellValue('B' . $stt, $site->site->user->username)
                        ->setCellValue('C' . $stt, $site->site->user->contact_name)
                        ->setCellValue('D' . $stt, $site->site->sitename)
                        ->setCellValue('E' . $stt, $site->begin . ' -> ' . $site->end)
                        ->setCellValue('F' . $stt, $report[0]->realclick)
                        ->setCellValue('G' . $stt, $siteInfo->price_buy)
                        ->setCellValue('H' . $stt, $site->money)
                        ->setCellValue('I' . $stt, '')
                        ->setCellValue('J' . $stt, $userInfo->stk)
                        ->setCellValue('K' . $stt, $userInfo->bank_name . ' - ' . $userInfo->branch_name)
                        ->setCellValue('L' . $stt, $userInfo->masothue)
                        ->setCellValue('M' . $stt, $userInfo->cmt)
                        ->setCellValue('N' . $stt, $userInfo->address)
                        ->setCellValue('O' . $stt, ($site->status == 0) ? 'Chưa thanh toán' : 'Đã thanh toán')
                        ->setCellValue('P' . $stt, '')
                        ->setCellValue('Q' . $stt, '');
                    $stt++;
                }
            }
        }

// Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle("Báo cáo dư nợ");
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

    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'utf-8//IGNORE', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}