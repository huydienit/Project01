<?php

namespace Adtech\VideoAnalytics\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('modules.video-analytics.dashboard.index');
    }
}
