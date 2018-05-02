<?php

namespace Adtech\Core\App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Adtech\Core\App\Repositories\UserRepository;
use Adtech\Core\App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
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
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
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

        $roleList = Role::where('status', 1)->get();
        $orderField = 'user_id';
        $orderSort = 'asc';
        $activeList = [0 => ['id' => 1, 'name' => 'wait'], 1 => ['id' => 2, 'name' => 'activated']];
        $statusList = [0 => ['id' => 1, 'name' => 'off'], 1 => ['id' => 2, 'name' => 'on']];
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
        $total = $this->user->countAll($keyword, $matchThese, $limit, $orderField, $orderSort, $role);
        $users = $userEmpty = [];
        if ($userData && count($userData) > 0) {
            foreach ($userData as $k => $user) {
                $users[] = [
                    'id' => $user->user_id,
                    'email' => $user->email,
                    'username' => $user->username,
                    'contact_name' => $user->contact_name,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'status' => $user->status,
                    'statusLB' => ($user->status == 1) ? true : false,
                    'activatedLBB' => ($user->activated == 1) ? "Activated" : "Wait",
                    'permission_lockedLB' => ($user->permission_locked == 1) ? true : false,
                    'role_id' => isset($user->roles[0]) ? $user->roles[0]->role_id : null,
                    'role_name' => isset($user->roles[0]) ? $user->roles[0]->name : null,
                    'permission_locked' => $user->permission_locked,
                    'url_permission_details' => route('adtech.core.permission.details', [
                        'object_type' => 'user',
                        'object_id' => $user->user_id,
                    ])
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
            'activeList' => json_encode($activeList),
            'statusList' => json_encode($statusList)
        ];
        return view('modules.core.user.manage', $data);
    }

    public function show(Request $request)
    {
        $user_id = $request->input('id');
        $user = $this->user->findID($user_id);
        return $user;
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:adtech_core_users',
            'password' => 'required|min:6|max:191|confirmed|regex:/^[a-zA-Z0-9_-]{6,18}$/',
            'password_confirmation' => 'required|min:6|max:191',
            'username' => 'required|unique:adtech_core_users|max:191|min:2|regex:/^[A-Za-z0-9]+$/i',
            'contact_name' => 'required',
            'status' => 'boolean',
            'activated' => 'boolean',
            'permission_locked' => 'boolean'
        ], $this->messages);
        if (!$validator->fails()) {
            $user = $this->user->create([
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'contact_name' => $request->input('contact_name'),
                'password' => Hash::make($request->input('password')),
                'status' => ($request->input('status')) ? 1 : 0,
                'activated' => ($request->input('activated')) ? 1 : 0,
                'permission_locked' => ($request->input('permission_locked')) ? 1 : 0,
                'salt' => 'jAV',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $user_id = $user->user_id;
            $role_id = $request->input('role_id');
            DB::insert('insert into g_adtech_core_users_role (user_id, role_id, created_at, updated_at) values (?, ?, ?, ?)',
                [$user_id, $role_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);

            $user = $this->user->findID($user_id);
            return $user;
        } else {
            return $validator->messages();
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'role_id' => 'required|numeric',
            'contact_name' => 'required',
            'activated' => 'boolean',
            'permission_locked' => 'boolean',
        ], $this->messages);
        if ($request->input('change_pass')) {
            $validatorPass = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'password' => 'required|min:6|max:191|confirmed|regex:/^[a-zA-Z0-9_-]{6,18}$/',
                'password_confirmation' => 'required|min:6|max:191',
            ], $this->messages);
            if (!$validatorPass->fails()) {
                $user_id = $request->input('user_id');
                $this->user->update([
                    'password' => Hash::make($request->input('password'))
                ], $user_id, 'user_id');
            } else {
                return $validatorPass->messages();
            }
        }
        if (!$validator->fails()) {
            $user_id = $request->input('user_id');
            $this->user->update([
                'contact_name' => $request->input('contact_name'),
                'status' => ($request->input('status')) ? 1 : 0,
                'activated' => ($request->input('activated')) ? 1 : 0,
                'permission_locked' => ($request->input('permission_locked')) ? 1 : 0,
            ], $user_id, 'user_id');

            $role_id = $request->input('role_id');
            $user_role_item = DB::select('select * from g_adtech_core_users_role where user_id = :id', ['id' => $user_id]);
            if (null == $user_role_item) {
                DB::insert('insert into g_adtech_core_users_role (user_id, role_id, created_at, updated_at) values (?, ?, ?, ?)',
                    [$user_id, $role_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
            } else {
                DB::update('update g_adtech_core_users_role set role_id = ?, updated_at = ? where user_id = ?', [$role_id, date('Y-m-d H:i:s'), $user_id]);
            }

            $user = $this->user->findID($user_id);
            return $user;
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
