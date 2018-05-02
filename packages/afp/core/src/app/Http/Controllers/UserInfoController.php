<?php

namespace Afp\Core\App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\UserInfoRepository;
use Adtech\Core\App\Repositories\UserRepository;
use Adtech\Core\App\Models\Role;
use Afp\Core\App\Models\Province;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserInfoController extends Controller
{
    /**
     * @var UserInfoRepository
     * @var UserRepository
     */
    private $userInfoRepository;
    private $userRepository;
    private $arrType = ['-', 'Cá nhân', 'Công ty'];
    private $messages = array(
        'required' => "Bắt buộc",
        'email' => "Email không chính xác",
        'unique'    => "Đã tồn tại email/username",
        'regex' => "Sai định dạng",
        'max' => "Chuỗi quá dài",
        'min' => "Chuỗi quá ngắn",
        'boolean' => "Sai định dạng",
        'confirmed' => "Xác nhận không chính xác",
    );

    public function __construct(UserRepository $userRepository, UserInfoRepository $userInfoRepository)
    {
        parent::__construct();
        $this->userInfo = $userInfoRepository;
        $this->user = $userRepository;
    }

    public function manage(Request $request)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);
        $keyword = trim($request->input('keyword', ''));
        $order = trim($request->input('order', 'id'));
        $role = (int)$request->input('role');
        $active = (int)$request->input('active');
        $status = (int)$request->input('status');

        $provinceList = Province::get();
        $roleList = Role::where('status', 1)->get();
        $orderField = 'user_id';
        $orderSort = 'asc';
        $activeList = [0 => ['id' => 1, 'name' => 'wait'], 1 => ['id' => 2, 'name' => 'activated']];
        $statusList = [0 => ['id' => 1, 'name' => 'off'], 1 => ['id' => 2, 'name' => 'on']];
        $typeList = [0 => ['id' => 1, 'name' => 'Cá nhân'], 1 => ['id' => 2, 'name' => 'Công ty']];
        $arrOrder = [
            'id' => ($order == 'id') ? '-id' : 'id',
            'email' => ($order == 'email') ? '-email' : 'email',
            'username' => ($order == 'username') ? '-username' : 'username',
        ];

        switch ($order) {
            case 'id':
                $orderField = 'user_id';
                $orderSort = 'asc';
                break;
            case '-id':
                $orderField = 'user_id';
                $orderSort = 'desc';
                break;
            case 'email':
                $orderField = 'email';
                $orderSort = 'asc';
                break;
            case '-email':
                $orderField = 'email';
                $orderSort = 'desc';
                break;
            case 'username':
                $orderField = 'username';
                $orderSort = 'asc';
                break;
            case '-username':
                $orderField = 'username';
                $orderSort = 'desc';
                break;
        }

        $matchThese = ['status' => 1];
        if ($active > 0) {
            $matchThese['activated'] = ($active - 1);
        }
        if ($status > 0) {
            $matchThese['status'] = ($status - 1);
        }
        $userData = $this->user->findAllByFilter($keyword, $matchThese, $limit, $orderField, $orderSort, $role);

        $total = $this->user->countAll();
        $users = $userEmpty = [];
        if ($userData && count($userData) > 0) {
            foreach ($userData as $k => $user) {
                $infoDetail = $this->userInfo->getById($user->user_id);
                if (null != $infoDetail) {
                    $type = $this->arrType[$infoDetail->type];
                    $email = $infoDetail->email;
                    $phone = $infoDetail->phone;
                    $contact_name = $infoDetail->name;
                    $contact_status = ($infoDetail->status==1)?"Đã duyệt":"Chưa duyệt";
                } else {
                    $type = '-';
                    $email = '-';
                    $phone = '-';
                    $contact_name = '-';
                    $contact_status = '-';
                }
                $users[] = [
                    'id' => $user->user_id,
                    'email' => $user->email,
                    'username' => $user->username,
                    'contact_name' => $contact_name,
                    'contact_type' => $type,
                    'contact_email' => $email,
                    'contact_phone' => $phone,
                    'contact_status' => $contact_status,
                ];
            }
        } else {
            $userEmpty[] = [
                'name' => trans('adtech-core::labels.empty')
            ];
        }
        $data = [
            'jsonUserEmptyString' => json_encode($userEmpty),
            'jsonUserString' => json_encode($users),
            'arrOrder' => json_encode($arrOrder),
            'pageIndex' => $pageIndex,
            'total' => $total,
            'limit' => $limit,
            'order' => $order,
            'role' => $role,
            'active' => $active,
            'status' => $status,
            'keyword' => $keyword,
            'roleList' => $roleList,
            'provinceList' => json_encode($provinceList),
            'activeList' => json_encode($activeList),
            'statusList' => json_encode($statusList),
            'typeList' => json_encode($typeList)
        ];
        return view('modules.core.user-info.manage', $data);
    }

    public function show(Request $request)
    {
        $user_id = $request->input('id');
        $infoDetail = $this->userInfo->getById($user_id);
        $user = $this->user->findID($user_id);
        if (null != $infoDetail) {
            $user->contact_type = $infoDetail->type;
            $user->contact_name = $infoDetail->name;
            $user->contact_email = $infoDetail->email;
            $user->contact_phone = $infoDetail->phone;
            $user->contact_address = $infoDetail->address;
            $user->contact_bank_name = $infoDetail->bank_name;
            $user->contact_branch_name = $infoDetail->branch_name;
            $user->contact_stk = $infoDetail->stk;
            $user->contact_cmt = $infoDetail->cmt;
            $user->contact_email_cc = $infoDetail->email_cc;
            $user->contact_manager_name = $infoDetail->manager_name;
            $user->contact_website = $infoDetail->website;
            $user->contact_sohopdong = $infoDetail->sohopdong;
            $user->contact_masothue = $infoDetail->masothue;
            $user->contact_noicap = $infoDetail->noicap;
            $user->contact_statusLB = ($infoDetail->status==1)?true:false;
        }
        return $user;
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'contact_name' => 'required',
            'contact_type' => 'required|numeric',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
            'contact_address' => 'required',
            'contact_bank_name' => 'required',
            'contact_branch_name' => 'required',
            'contact_stk' => 'required',
            'contact_cmt' => 'required',
            'contact_noicap' => 'required|numeric',
        ], $this->messages);
        $code = ''; $check = false;
        $provinceDetail = Province::find($request->input('contact_noicap'));
        $arrCode = explode(',', $provinceDetail->code);
        $arrCodeNew = explode(',', $provinceDetail->code_new);
        if (strlen($request->input('contact_cmt')) == 9) {
            if(count($arrCode)>0){
                foreach($arrCode as $key=>$value){
                    $code = $value;
                    if(strlen($value)==1){
                        $code = '0'.$value;
                    }
                    if(substr($request->input('contact_cmt'), 0, strlen($code)) == $code){
                        $check = true;
                        break;
                    }
                }
            }
        }
        if (strlen($request->input('contact_cmt')) == 12) {
            if(count($arrCodeNew)>0){
                foreach($arrCodeNew as $key=>$value){
                    $code = $value;
                    if(strlen($value)==1){
                        $code = '0'.$value;
                    }
                    if(substr($request->input('contact_cmt'), 0, strlen($code)) == $code){
                        $check = true;
                        break;
                    }
                }
            }
        }

        if (!$validator->fails()) {
            if($check==true) {
                $user_id = $request->input('user_id');
                $infoDetail = $this->userInfo->getById($user_id);
                if (null != $infoDetail) {
                    $this->userInfo->update([
                        'type' => $request->input('contact_type'),
                        'name' => $request->input('contact_name'),
                        'email' => $request->input('contact_email'),
                        'phone' => $request->input('contact_phone'),
                        'address' => $request->input('contact_address'),
                        'bank_name' => $request->input('contact_bank_name'),
                        'branch_name' => $request->input('contact_branch_name'),
                        'stk' => $request->input('contact_stk'),
                        'cmt' => $request->input('contact_cmt'),
                        'noicap' => $request->input('contact_noicap'),
                        'email_cc' => $request->input('contact_email_cc'),
                        'manager_name' => $request->input('contact_manager_name'),
                        'website' => $request->input('contact_website'),
                        'sohopdong' => $request->input('contact_sohopdong'),
                        'masothue' => $request->input('contact_masothue'),
                        'status' => ($request->input('contact_status')) ? 1 : 0,
                    ], $user_id, 'user_id');
                } else {
                    $user = $this->userInfo->create([
                        'user_id' => $user_id,
                        'type' => $request->input('contact_type'),
                        'name' => $request->input('contact_name'),
                        'email' => $request->input('contact_email'),
                        'phone' => $request->input('contact_phone'),
                        'address' => $request->input('contact_address'),
                        'bank_name' => $request->input('contact_bank_name'),
                        'branch_name' => $request->input('contact_branch_name'),
                        'stk' => $request->input('contact_stk'),
                        'cmt' => $request->input('contact_cmt'),
                        'noicap' => $request->input('contact_noicap'),
                        'email_cc' => $request->input('contact_email_cc'),
                        'manager_name' => $request->input('contact_manager_name'),
                        'website' => $request->input('contact_website'),
                        'sohopdong' => $request->input('contact_sohopdong'),
                        'masothue' => $request->input('contact_masothue'),
                        'status' => ($request->input('contact_status')) ? 1 : 0,
                    ]);
                }
                $infoDetail = $this->userInfo->getById($user_id);
                $user = $this->user->findID($user_id);
                if (null != $infoDetail) {
                    $user->contact_type = $this->arrType[$infoDetail->type];
                    $user->contact_name = $infoDetail->name;
                    $user->contact_email = $infoDetail->email;
                    $user->contact_phone = $infoDetail->phone;
                    $user->contact_address = $infoDetail->address;
                    $user->contact_bank_name = $infoDetail->bank_name;
                    $user->contact_branch_name = $infoDetail->branch_name;
                    $user->contact_stk = $infoDetail->stk;
                    $user->contact_cmt = $infoDetail->cmt;
                    $user->contact_email_cc = $infoDetail->email_cc;
                    $user->contact_manager_name = $infoDetail->manager_name;
                    $user->contact_website = $infoDetail->website;
                    $user->contact_sohopdong = $infoDetail->sohopdong;
                    $user->contact_masothue = $infoDetail->masothue;
                    $user->contact_status = ($infoDetail->status==1)?"Đã duyệt":"Chưa duyệt";
                }
                return $user;
            } else {
                $validator->errors()->add('cmt', 'Sai chứng minh thư hoặc nơi cấp');
                return $validator->messages();
            }
        } else {
            return $validator->messages();
        }
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'email' => 'required|email',
        ], $this->messages);
        if (!$validator->fails()) {
            $user_id = $request->input('user_id');
            $this->user->update([
                'status' => -1
            ], $user_id, 'user_id');

            $user = $this->user->findID($user_id);
            return $user;
        } else {
            return $validator->messages();
        }
    }

    public function status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'status' => 'required|boolean',
        ], $this->messages);
        if (!$validator->fails()) {
            $user_id = $request->input('user_id');
            $this->user->update([
                'status' => ($request->input('status')) ? 1 : 0,
            ], $user_id, 'user_id');

            $user = $this->user->findID($user_id);
            return $user;
        } else {
            return $validator->messages();
        }
    }
}
