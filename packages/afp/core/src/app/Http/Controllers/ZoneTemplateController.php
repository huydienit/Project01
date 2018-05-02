<?php

namespace Afp\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\ZoneTemplateRepository;
use Afp\Core\App\Models\ZoneTemplate;
use Validator;

class ZoneTemplateController extends Controller
{
    /**
     * @var ZoneTemplateRepository
     */
    private $zoneTemplateRepository;

    public function __construct(ZoneTemplateRepository $zoneTemplateRepository)
    {
        parent::__construct();
        $this->zoneTemplate = $zoneTemplateRepository;
    }

    public function manage(Request $request)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);

        $zoneTemplatesData = $this->zoneTemplate->findAllByPaginate($limit);
        $zoneTemplates = array();
        if ($zoneTemplatesData) {
            foreach ($zoneTemplatesData as $k => $zoneTemplate) {
                $zoneTemplates[] = [
                    'id' => $zoneTemplate->id,
                    'name' => $zoneTemplate->name,
                    'created_at' => $zoneTemplate->created_at,
                    'updated_at' => $zoneTemplate->updated_at,
                ];
            }
        }
        $total = $this->zoneTemplate->countAll();
        $data = [
            'jsonzoneTemplateString' => json_encode($zoneTemplates),
            'pageIndex' => $pageIndex,
            'total' => $total,
            'limit' => $limit,
        ];
        return view('modules.core.zone-template.manage', $data);
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        return $this->zoneTemplate->find($id);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
        ]);
        if (!$validator->fails()) {
            $zoneTemplate = $this->zoneTemplate->create([
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]);
            $zoneTemplate->success = true;
            return $zoneTemplate;
        } else {
            return $validator->messages();
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'code' => 'required',
        ]);
        if (!$validator->fails()) {
            $id = $request->input('id');
            $this->zoneTemplate->update([
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ], $id, 'id');

            $zoneTemplate = $this->zoneTemplate->find($id);
            $zoneTemplate->success = true;
            return $zoneTemplate;
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
            $this->zoneTemplate->update([
                'status' => -1
            ], $id, 'id');

            $zoneTemplate = $this->zoneTemplate->find($id);
            $zoneTemplate->success = true;
            return $zoneTemplate;
        } else {
            return $validator->messages();
        }
    }
}
