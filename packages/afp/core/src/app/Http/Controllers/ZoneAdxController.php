<?php

namespace Afp\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\SiteRepository;
use Afp\Core\App\Repositories\ZoneAdxRepository;
use Afp\Core\App\Repositories\BoxFormatRepository;
use Afp\Core\App\Repositories\ZoneTemplateRepository;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ZoneAdxController extends Controller
{
    /**
     * @var SiteRepository
     * @var ZoneAdxRepository
     * @var BoxFormatRepository
     * @var ZoneTemplateRepository
     */
    private $siteRepository;
    private $zoneAdxRepository;
    private $boxFormatRepository;
    private $zoneTemplateRepository;

    public function __construct(SiteRepository $siteRepository,
                                ZoneAdxRepository $zoneAdxRepository,
                                BoxFormatRepository $boxFormatRepository,
                                ZoneTemplateRepository $zoneTemplateRepository)
    {
        parent::__construct();
        $this->site = $siteRepository;
        $this->zoneAdx = $zoneAdxRepository;
        $this->boxFormat = $boxFormatRepository;
        $this->zoneTemplate = $zoneTemplateRepository;
    }

    public function manage(Request $request, $site_id)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);

        $siteDetail = $this->site->findID($site_id);
        if (null != $siteDetail) {
            $total = $this->zoneAdx->countAll();
            $boxFormatList = $this->boxFormat->findAll('status', 1);
            $zoneTemplateList = $this->zoneTemplate->findAll('status', 1);
            $zoneAdxsData = $this->zoneAdx->findAllByPaginate($limit);
            $zoneAdxs = array();
            if ($zoneAdxsData) {
                foreach ($zoneAdxsData as $k => $zoneAdx) {
                    $zoneAdxs[] = [
                        'id' => $zoneAdx->zoneadx_id,
                        'name' => $zoneAdx->name,
                        'status' => $zoneAdx->status,
                        'statusLB' => ($zoneAdx->status == 1) ? true : false,
                        'created_at' => $zoneAdx->created_at,
                        'updated_at' => $zoneAdx->updated_at,
                    ];
                }
            }
        } else {
            return redirect()->route('afp.core.site.manage');
        }

        $data = [
            'jsonzoneAdxString' => json_encode($zoneAdxs),
            'zoneTemplateList' => $zoneTemplateList,
            'boxFormatList' => $boxFormatList,
            'pageIndex' => $pageIndex,
            'site_id' => $site_id,
            'total' => $total,
            'limit' => $limit,
        ];
        return view('modules.core.zone-adx.manage', $data);
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        $data = $this->zoneAdx->findID($id);
        return $data;
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => 'required|numeric',
            'box_format_id' => 'required|numeric'
        ]);
        if (!$validator->fails()) {
            $siteDetail = $this->site->findID($request->input('site_id'));
            $boxFormatDetail = $this->boxFormat->getById($request->input('box_format_id'));
            $zoneTemplateDetail = $this->zoneTemplate->getById($request->input('zone_template_id'));
            $name = $siteDetail->sitename . '-' . $boxFormatDetail->name . '-' . $zoneTemplateDetail->code;
            $zoneAdx = $this->zoneAdx->create([
                'site_id' => $request->input('site_id'),
                'box_format_id' => $request->input('box_format_id'),
                'zone_template_id' => $request->input('zone_template_id'),
                'name' => $name,
                'notes' => $request->input('notes'),
                'status' => $request->input('status'),
                'hidden_label' => $request->input('hiddenLabel'),
                'is_banner_default' => $request->input('bannerDefault'),
            ]);

            $data = $this->zoneAdx->findID($zoneAdx->zoneadx_id);
            return $data;
        } else {
            return $validator->messages();
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => 'required|numeric',
            'box_format_id' => 'required|numeric'
        ]);
        if (!$validator->fails()) {
            $id = $request->input('zoneadx_id');
            $siteDetail = $this->site->findID($request->input('site_id'));
            $boxFormatDetail = $this->boxFormat->getById($request->input('box_format_id'));
            $zoneTemplateDetail = $this->zoneTemplate->getById($request->input('zone_template_id'));
            $name = $siteDetail->sitename . '-' . $boxFormatDetail->name . '-' . $zoneTemplateDetail->code;
            $this->zoneAdx->update([
                'site_id' => $request->input('site_id'),
                'box_format_id' => $request->input('box_format_id'),
                'zone_template_id' => $request->input('zone_template_id'),
                'name' => $name,
                'notes' => $request->input('notes'),
                'status' => $request->input('status'),
                'hidden_label' => $request->input('hiddenLabel'),
            ], $id, 'zoneadx_id');

            $data = $this->zoneAdx->findID($id);
            return $data;
        } else {
            return $validator->messages();
        }
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric'
        ]);
        if (!$validator->fails()) {
            $id = $request->input('id');
            $this->zoneAdx->update([
                'status' => -1
            ], $id, 'zoneadx_id');
            return ['success' => true];
        } else {
            return $validator->messages();
        }
    }

    public function status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'zoneadx_id' => 'required|numeric',
            'status' => 'required|boolean',
        ]);
        if (!$validator->fails()) {
            $id = $request->input('zoneadx_id');
            $this->zoneAdx->update([
                'status' => ($request->input('status')) ? 1 : 0,
            ], $id, 'zoneadx_id');

            $data = $this->zoneAdx->findID($id);
            return $data;
        } else {
            return $validator->messages();
        }
    }
}
