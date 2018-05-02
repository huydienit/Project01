<?php

namespace Adtech\Core\App\Http\Controllers;

use Adtech\Core\App\Repositories\RoleRepository;
use Adtech\Core\App\Repositories\UserRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Adtech\Core\App\Models\Acl;
use Illuminate\Http\Request;
use Adtech\Core\App\Models\Role;
use Validator;
use Auth;
use Adtech\Application\Cms\Controllers\Controller as Controller;

class PermissionController extends Controller
{
    /**
     * @var UserRepository
     */
    private $_userRepository;

    /**
     * @var RoleRepository
     */
    private $_roleRepository;
    private static $_aclKey = 'ADTECH_CMS_ACL_RULES';

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        parent::__construct();
        $this->_userRepository = $userRepository;
        $this->_roleRepository = $roleRepository;
    }

    public function details(Request $request, $objectType, $objectId)
    {
        $arrPackage = [];
        $arrModule = [];
        $filter_package = [];
        $filter_module = [];
        $arrCanAccess = [];
        $object = null;
        $objectType = strtolower($objectType);
        switch ($objectType) {
            case 'role':
                $object = $this->_roleRepository->getById($objectId);
                break;
            case 'group':
                break;
            case 'user':
                $object = $this->_userRepository->getById($objectId);
                $object->name = $object->email;
                break;
        }

        if (null == $object) {
            abort(404);
        }

        if ($object->permission_locked == true) {
            abort(403);
        }

        $app = app();
        $routes = $app->routes->getRoutes();
        if (count($routes) > 0) {
//            $validator = Validator::make($request->all(), [
//                'package' => 'required',
//                'module' => 'required',
//            ]);
            $delimiter = array(" ", ",", ".", "'", "\"", "|", "\\", "/", ";", ":");
            foreach ($routes as $k => $route) {
                if (isset($route->action['controller'])) {
                    if (isset($route->action['as'])) {
                        if ($object->canAccess($route->action['as'])) {
                            $arrCanAccess[] = $route->action['as'];
                        }
                    }
                    $controller = $route->action['controller'];
                    $replace = str_replace($delimiter, $delimiter[0], $controller);
                    $explode = explode($delimiter[0], $replace);
                    $arrPackage[strtolower($explode[0])] = [
                        'slug' => strtolower($explode[0]),
                        'name' => $explode[0],
                    ];
                    $arrModule[strtolower($explode[1])] = [
                        'slug' => strtolower($explode[1]),
                        'name' => $explode[1]
                    ];
                    $package_slug = strtolower($explode[0]);
                    $module_slug = strtolower($explode[1]);
                } else {
                    $package_slug = '';
                    $module_slug = '';
                }
                if ($request->has('package')) {
                    if ($request->input('package') != $package_slug) {
                        unset($routes[$k]);
                    }
                    $filter_package = [
                        'slug' => $request->input('package'),
                        'name' => ucfirst($request->input('package'))
                    ];
                }
                if ($request->has('module')) {
                    if ($request->input('module') != $module_slug) {
                        unset($routes[$k]);
                    }
                    $filter_module = [
                        'slug' => $request->input('module'),
                        'name' => ucfirst($request->input('module'))
                    ];
                }
            }
        }
        $roleList = Role::get();
        $data = [
            'routes' => compact('routes'),
            'objectType' => $objectType,
            'objectId' => $objectId,
            'object' => $object,
            'arrPackage' => json_encode($arrPackage),
            'arrModule' => json_encode($arrModule),
            'filter_package' => json_encode($filter_package),
            'filter_module' => json_encode($filter_module),
            'arrCanAccess' => json_encode($arrCanAccess),
            'roleList' => $roleList,
        ];

        return view('modules.core.permission.details', $data);
    }

    public function set(Request $request)
    {
        $user_id = Auth::id();
        $objectType = $request->input('object_type', 'role');
        $objectId = (int)$request->input('object_id');
        $allow = (int)$request->input('allow');
        $object = null;

        switch ($objectType) {
            case 'role':
                $object = $this->_roleRepository->getById($objectId);
                break;
            case 'group':
                break;
            case 'user':
                $object = $this->_userRepository->getById($objectId);
                break;
        }

        if (null == $object) {
            abort(404);
        }

        $route_name = $request->input('route_name');
        $route_name_crc = abs(crc32($route_name));
        $arrName = explode('.', $route_name);

        $acl = Acl::where('object_type', $objectType)
            ->where('object_id', $objectId)
            ->where('route_name_crc', $route_name_crc)->first();

//        $acl = Acl::find(1);
        if (null == $acl) {
            $acl = new Acl();
        }
        $acl->object_id = $objectId;
        $acl->object_type = $objectType;
        $acl->allow = $allow;
        $acl->route_name = $route_name;
        $acl->route_name_crc = $route_name_crc;
        $acl->created_user_id = $user_id;
        $acl->created_at = date('Y-m-d H:i:s');
        $acl->updated_at = date('Y-m-d H:i:s');
        $acl->vendor = $arrName[0];
        $acl->package = $arrName[1];
        $acl->params = '';
        if ($acl->save()) {
            $cache = Cache::store('file');
            $cache->forget(self::$_aclKey);
            $columns = [
                DB::raw('CONCAT(`object_type`, \'_\', `object_id`) as `role_name`'),
                'allow', 'route_name'
            ];
            $data = Acl::select($columns)
                ->where('route_name_crc', '=', '0')
                ->union(Acl::select($columns)
                    ->where('route_name_crc', '<>', '0'))
                ->get();
            $data && $cache->forever(self::$_aclKey, $data);
        }

        $response = [
            'data' => $acl,
        ];
        return response()->json($response);
    }
}
