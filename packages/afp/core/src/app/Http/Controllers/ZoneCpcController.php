<?php

namespace Afp\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\SiteRepository;
use Afp\Core\App\Repositories\ZoneCpcRepository;
use Afp\Core\App\Repositories\BoxFormatRepository;
use Afp\Core\App\Repositories\ZoneTemplateRepository;
use Validator;

class ZoneCpcController extends Controller
{
    /**
     * @var SiteRepository
     * @var ZoneCpcRepository
     * @var BoxFormatRepository
     * @var ZoneTemplateRepository
     */
    private $siteRepository;
    private $zoneCpcRepository;
    private $boxFormatRepository;
    private $zoneTemplateRepository;

    public function __construct(SiteRepository $siteRepository,
                                ZoneCpcRepository $zoneCpcRepository,
                                BoxFormatRepository $boxFormatRepository,
                                ZoneTemplateRepository $zoneTemplateRepository)
    {
        parent::__construct();
        $this->site = $siteRepository;
        $this->zoneCpc = $zoneCpcRepository;
        $this->boxFormat = $boxFormatRepository;
        $this->zoneTemplate = $zoneTemplateRepository;
    }

    public function manage(Request $request, $site_id)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);

        $boxFormatList = $this->boxFormat->findAll('status', 1);
        $zoneTemplateList = $this->zoneTemplate->findAll('status', 1);
        $zoneCpcsData = $this->zoneCpc->findAllByPaginate($site_id, $limit);
        $zoneCpcs = array();
        if ($zoneCpcsData) {
            foreach ($zoneCpcsData as $k => $zoneCpc) {
                $zoneCpcs[] = [
                    'id' => $zoneCpc->zonecpc_id,
                    'name' => $zoneCpc->name,
                    'status' => $zoneCpc->status,
                    'statusLB' => ($zoneCpc->status == 1) ? true : false,
                    'created_at' => $zoneCpc->created_at,
                    'updated_at' => $zoneCpc->updated_at,
                ];
            }
        }
        $total = $this->zoneCpc->countAll($site_id);
        $sitename = $this->site->find($site_id)->sitename;
        $username = $this->site->find($site_id)->user->username;
        $data = [
            'jsonzoneCpcString' => json_encode($zoneCpcs),
            'zoneTemplateList' => $zoneTemplateList,
            'boxFormatList' => $boxFormatList,
            'pageIndex' => $pageIndex,
            'sitename' => $sitename,
            'username' => $username,
            'site_id' => $site_id,
            'total' => $total,
            'limit' => $limit,
        ];
        return view('modules.core.zone-cpc.manage', $data);
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        $data = $this->zoneCpc->findID($id);
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
            $zoneCpc = $this->zoneCpc->create([
                'site_id' => $request->input('site_id'),
                'box_format_id' => $request->input('box_format_id'),
                'zone_template_id' => $request->input('zone_template_id'),
                'name' => $name,
                'notes' => $request->input('notes'),
                'status' => $request->input('status'),
                'hidden_label' => $request->input('hiddenLabel'),
            ]);

            $data = $this->zoneCpc->findID($zoneCpc->zonecpc_id);
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
            $id = $request->input('zonecpc_id');
            $siteDetail = $this->site->findID($request->input('site_id'));
            $boxFormatDetail = $this->boxFormat->getById($request->input('box_format_id'));
            $zoneTemplateDetail = $this->zoneTemplate->getById($request->input('zone_template_id'));
            $name = $siteDetail->sitename . '-' . $boxFormatDetail->name . '-' . $zoneTemplateDetail->code;
            $this->zoneCpc->update([
                'site_id' => $request->input('site_id'),
                'box_format_id' => $request->input('box_format_id'),
                'zone_template_id' => $request->input('zone_template_id'),
                'name' => $name,
                'notes' => $request->input('notes'),
                'status' => $request->input('status'),
                'hidden_label' => $request->input('hiddenLabel'),
            ], $id, 'zonecpc_id');

            $data = $this->zoneCpc->findID($id);
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
            $this->zoneCpc->update([
                'status' => -1
            ], $id, 'zonecpc_id');

            $data = $this->zoneCpc->findID($id);
            return $data;
        } else {
            return $validator->messages();
        }
    }

    public function status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'zonecpc_id' => 'required|numeric',
            'status' => 'required|boolean',
        ]);
        if (!$validator->fails()) {
            $id = $request->input('zonecpc_id');
            $this->zoneCpc->update([
                'status' => ($request->input('status')) ? 1 : 0,
            ], $id, 'zonecpc_id');

            $data = $this->zoneCpc->findID($id);
            return $data;
        } else {
            return $validator->messages();
        }
    }
}
