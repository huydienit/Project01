<?php

namespace Adtech\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Route;

class RouteController extends Controller
{
    public function manage(Request $request)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 10);

        $app = app();
        $routes = $app->routes->getRoutes();
        $data = [
            'routes' => compact('routes'),
            'pageIndex' => $pageIndex,
            'limit' => $limit,
        ];
        return view('modules.core.route.manage', $data);
    }
}
