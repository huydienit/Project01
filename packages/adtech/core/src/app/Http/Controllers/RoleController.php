<?php

namespace Adtech\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Adtech\Core\App\Repositories\RoleRepository;
use Adtech\Core\App\Models\Role;
use Adtech\Core\App\Models\Acl;
use Validator;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;
    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số",
        'name.max' => "Tên quá dài",
        'name.min' => "Tên quá ngắn",
    );

    public function __construct(RoleRepository $roleRepository)
    {
        parent::__construct();
        $this->role = $roleRepository;
    }

    public function manage(Request $request)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);

        $rolesData = $this->role->findAllByPaginate('status', 1, $limit);
        $roles = array();
        if ($rolesData) {
            foreach ($rolesData as $k => $role) {
                $roles[] = [
                    'id' => $role->role_id,
                    'name' => $role->name,
                    'created_at' => $role->created_at,
                    'updated_at' => $role->updated_at,
                    'permission_locked' => $role->permission_locked,
                    'url_permission_details' => route('adtech.core.permission.details', [
                        'object_type' => 'role',
                        'object_id' => $role->role_id,
                    ])
                ];
            }
        }
        $total = $this->role->countAll();
        $data = [
            'jsonRoleString' => json_encode($roles),
            'pageIndex' => $pageIndex,
            'total' => $total,
            'limit' => $limit,
        ];
        return view('modules.core.role.manage', $data);
    }

    public function show(Request $request)
    {
        $role_id = $request->input('id');
        return $this->role->find($role_id);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191|min:2|regex:/^[A-Za-z0-9 _-]+$/i',
        ], $this->messages);
        if (!$validator->fails()) {
            $role = $this->role->create([
                'name' => $request->input('name'),
                'permission_locked' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $role->id = $role->role_id;
            $role->url_permission_details = route('adtech.core.permission.details', [
                'object_type' => 'role',
                'object_id' => $role->role_id,
            ]);
            $role->success = true;
            return $role;
        } else {
            return $validator->messages();
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|numeric',
            'name' => 'required|max:191|min:2|regex:/^[A-Za-z0-9 _-]+$/i',
        ], $this->messages);
        if (!$validator->fails()) {
            $role_id = $request->input('role_id');
            $this->role->update([
                'name' => $request->input('name')
            ], $role_id, 'role_id');

            $role = $this->role->find($role_id);
            $role->id = $role_id;
            $role->url_permission_details = route('adtech.core.permission.details', [
                'object_type' => 'role',
                'object_id' => $role_id,
            ]);
            $role->success = true;
            return $role;
        } else {
            return $validator->messages();
        }
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|numeric',
        ], $this->messages);
        if (!$validator->fails()) {
            $role_id = $request->input('role_id');
            $this->role->update([
                'status' => 0
            ], $role_id, 'role_id');

            $role = $this->role->find($role_id);
            $role->id = $role_id;
            $role->url_permission_details = route('adtech.core.permission.details', [
                'object_type' => 'role',
                'object_id' => $role_id,
            ]);
            $role->success = true;
            return $role;
        } else {
            return $validator->messages();
        }
    }
}
