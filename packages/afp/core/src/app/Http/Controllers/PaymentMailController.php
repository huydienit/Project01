<?php

namespace Afp\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\PaymentMailRepository;
use Validator;

class PaymentMailController extends Controller
{
    /**
     * @var paymentMailRepository
     */
    private $paymentMailRepository;
    private $messages = array(
        'required' => "Bắt buộc",
        'email' => "Email không chính xác",
        'unique' => "Đã tồn tại email/username",
        'regex' => "Sai định dạng",
        'max' => "Chuỗi quá dài",
        'min' => "Chuỗi quá ngắn",
        'boolean' => "Sai định dạng",
        'confirmed' => "Xác nhận không chính xác",
        'numeric' => "Yêu cầu là số",
    );

    public function __construct(PaymentMailRepository $paymentMailRepository)
    {
        parent::__construct();
        $this->paymentMail = $paymentMailRepository;
    }

    public function manage(Request $request)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);

        $typeList = [0 => ['id' => 0, 'name' => ''], 1 => ['id' => 1, 'name' => 'CC'], 2 => ['id' => 2, 'name' => 'Bcc']];

        $paymentMailsData = $this->paymentMail->findAllByPaginate($limit);
        $paymentMails = array();
        if ($paymentMailsData) {
            foreach ($paymentMailsData as $k => $paymentMail) {
                $paymentMails[] = [
                    'id' => $paymentMail->id,
                    'email' => $paymentMail->email,
                    'type' => $typeList[$paymentMail->type]['name'],
                    'status' => $paymentMail->status,
                    'statusLB' => ($paymentMail->status == 1) ? true : false,
                    'created_at' => $paymentMail->created_at,
                    'updated_at' => $paymentMail->updated_at,
                ];
            }
        }
        $total = $this->paymentMail->countAll();
        $data = [
            'jsonpaymentMailString' => json_encode($paymentMails),
            'typeList' => json_encode($typeList),
            'pageIndex' => $pageIndex,
            'total' => $total,
            'limit' => $limit,
        ];
        return view('modules.core.payment-mail.manage', $data);
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        return $this->paymentMail->find($id);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:afp_payment_mail',
            'type' => 'numeric'
        ]);
        if (!$validator->fails()) {
            $paymentMail = $this->paymentMail->create([
                'email' => $request->input('email'),
                'type' => $request->input('type')
            ]);
            $siteData = $this->paymentMail->findID($paymentMail->id);
            return $siteData;
        } else {
            return $validator->messages();
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'email' => 'required|email|unique:afp_payment_mail',
            'type' => 'numeric'
        ]);
        if (!$validator->fails()) {
            $id = $request->input('id');
            $this->paymentMail->update([
                'email' => $request->input('email'),
                'type' => $request->input('type')
            ], $id, 'id');

            $siteData = $this->paymentMail->findID($id);
            return $siteData;
        } else {
            return $validator->messages();
        }
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if (!$validator->fails()) {
            $id = $request->input('id');
            $this->paymentMail->update([
                'status' => -1
            ], $id, 'id');

            $siteData = $this->paymentMail->findID($id);
            return $siteData;
        } else {
            return $validator->messages();
        }
    }

    public function status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'status' => 'required|boolean',
        ], $this->messages);
        if (!$validator->fails()) {
            $this->paymentMail->update([
                'status' => ($request->input('status')) ? 1 : 0,
            ], $request->input('id'), 'id');

            $siteData = $this->paymentMail->findID($request->input('id'));
            return $siteData;
        } else {
            return $validator->messages();
        }
    }
}
