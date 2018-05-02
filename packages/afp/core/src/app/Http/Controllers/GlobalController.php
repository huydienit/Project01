<?php

namespace Afp\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\TagRepository;
use Afp\Core\App\Repositories\SiteRepository;
use Afp\Core\App\Repositories\SiteAdxRepository;
use Afp\Core\App\Repositories\SiteCategoryRespository;
use Afp\Core\App\Repositories\BoxFormatRepository;
use Afp\Core\App\Repositories\ZoneTemplateRepository;
use Afp\Core\App\Repositories\ChannelRepository;
use Illuminate\Support\Facades\DB;
use Auth;

class GlobalController extends Controller
{
    /**
     * @var TagRepository
     * @var SiteRepository
     * @var SiteAdxRepository
     * @var SiteCategoryRespository
     * @var BoxFormatRepository
     * @var ZoneTemplateRepository
     * @var ChannelRepository
     */
    private $tagRepository;
    private $siteRepository;
    private $siteAdxRepository;
    private $siteCategoryRespository;
    private $boxFormatRespository;
    private $zoneTemplateRespository;
    private $channelRespository;

    public function __construct(TagRepository $tagRepository,
                                SiteRepository $siteRepository,
                                SiteAdxRepository $siteAdxRepository,
                                SiteCategoryRespository $siteCategoryRespository,
                                BoxFormatRepository $boxFormatRespository,
                                ZoneTemplateRepository $zoneTemplateRespository,
                                ChannelRepository $channelRespository)
    {
        parent::__construct();
        $this->tag = $tagRepository;
        $this->site = $siteRepository;
        $this->siteAdx = $siteAdxRepository;
        $this->siteCategory = $siteCategoryRespository;
        $this->boxFormat = $boxFormatRespository;
        $this->zoneTemplate = $zoneTemplateRespository;
        $this->channel = $channelRespository;
    }

    public function sync()
    {
        return view('modules.core.global.sync');
    }

    public function syncdata(Request $request)
    {
        $syncData = [];
        $data = $request->input('data');
        if (count($data) > 0) {
            foreach ($data as $id) {
                switch ($id) {
                    case 1:
                        $syncData[] = 'Category';
                        $data = DB::connection('mysql2')->table('reportingdb.self_serving_categories')->where('type', 1)->get();
                        if (count($data) > 0) {
                            foreach ($data as $item) {
                                $dataInsert[] = ['name' => $item->categoryname_vi, 'status' => 1];
                            }
                            DB::table('afp_site_category')->truncate();
                            DB::table('afp_site_category')->insert($dataInsert);
                        }
                        $syncData[] = $data;
                        break;
                    case 2:
                        $syncData[] = 'Tag';
                        $data = DB::connection('mysql2')->table('reportingdb.adm_tag')->where([
                            ['typead', 1],
                            ['tag_status', 1]
                        ])->get();
                        if (count($data) > 0) {
                            foreach ($data as $item) {
                                $dataInsert[] = ['name' => $item->tag_name, 'status' => 1];
                            }
                            DB::table('afp_site_tag')->truncate();
                            DB::table('afp_site_tag')->insert($dataInsert);
                        }
                        $syncData[] = $data;
                        break;
                    case 3:
                        $syncData[] = 'Box format';
                        $data = DB::connection('mysql2')->table('reportingdb.ox_box_format')->where('is_smallbiz', 3)->get();
                        if (count($data) > 0) {
                            foreach ($data as $item) {
                                $dataInsert[] = ['name' => $item->name, 'description' => $item->description];
                            }
                            DB::table('afp_site_box_format')->truncate();
                            DB::table('afp_site_box_format')->insert($dataInsert);
                        }
                        $syncData[] = $data;
                        break;
                    case 4:
                        $syncData[] = 'Zone template';
                        $data = DB::connection('mysql2')->table('reportingdb.ox_zone_template_type')->get();
                        if (count($data) > 0) {
                            foreach ($data as $item) {
                                $dataInsert[] = ['name' => $item->format_name, 'code' => $item->description];
                            }
                            DB::table('afp_site_zone_template')->truncate();
                            DB::table('afp_site_zone_template')->insert($dataInsert);
                        }
                        $syncData[] = $data;
                        break;
                    case 5:
                        $syncData[] = 'Channel';
                        $data = DB::connection('mysql2')->table('reportingdb.selfserving_site_channel')->get();
                        if (count($data) > 0) {
                            foreach ($data as $item) {
                                $dataInsert[] = ['name' => $item->name];
                            }
                            DB::table('afp_site_channel')->truncate();
                            DB::table('afp_site_channel')->insert($dataInsert);
                        }
                        $syncData[] = $data;
                        break;
                }
            }
        }
        return $syncData;
    }

    public function showalert(Request $request, $stt = 0)
    {
        $siteList = [];
        $siteData = $this->site->findAll('', 1000, 3);
        if ($siteData && count($siteData) > 0) {
            foreach ($siteData as $k => $site) {
                if ($stt > 2)
                    continue;
                $siteList[] = [
                    'sitename' => 'Site mới: ' . $site->sitename,
                    'username' => $site->user->username,
                    'created_at' => date("d/m/Y H:i", strtotime($site->info->created_at)),
                    'link' => '/admin/afp/core/site/manage?status=3&type=1'
                ];
                $stt++;
            }
        }
//        $siteData = $this->site->findAllAdx('', 1000, 3);
//        if ($siteData && count($siteData)>0) {
//            foreach ($siteData as $k => $site) {
//                if($stt>2)
//                    continue;
//                $siteList[] = [
//                    'sitename'  => 'Đăng ký ADX: '.$site->sitename,
//                    'username'  => $site->user->username,
//                    'created_at'    => date("d/m/Y H:i", strtotime($site->adx->created_at)),
//                    'link'  => '/admin/afp/core/site/manage?status=3&type=2'
//                ];
//                $stt++;
//            }
//        }
        return json_encode($siteList);
    }
}