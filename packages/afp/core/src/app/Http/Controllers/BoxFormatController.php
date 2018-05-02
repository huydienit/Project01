<?php

namespace Afp\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\BoxFormatRepository;
use Afp\Core\App\Models\BoxFormat;
use Validator;

class BoxFormatController extends Controller
{
    /**
     * @var BoxFormatRepository
     */
    private $boxFormatRepository;

    public function __construct(BoxFormatRepository $boxFormatRepository)
    {
        parent::__construct();
        $this->boxFormat = $boxFormatRepository;
    }

    public function manage(Request $request)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);

        $boxFormatsData = $this->boxFormat->findAllByPaginate('status', 1, $limit);
        $boxFormats = array();
        if ($boxFormatsData) {
            foreach ($boxFormatsData as $k => $boxFormat) {
                $boxFormats[] = [
                    'id' => $boxFormat->id,
                    'name' => $boxFormat->name,
                    'created_at' => $boxFormat->created_at,
                    'updated_at' => $boxFormat->updated_at,
                ];
            }
        }
        $total = $this->boxFormat->countAll();
        $data = [
            'jsonBoxFormatString' => json_encode($boxFormats),
            'pageIndex' => $pageIndex,
            'total' => $total,
            'limit' => $limit,
        ];
        return view('modules.core.box-format.manage', $data);
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        return $this->boxFormat->find($id);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if (!$validator->fails()) {
            $boxFormat = $this->boxFormat->create([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);
            $boxFormat->success = true;
            return $boxFormat;
        } else {
            return $validator->messages();
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required'
        ]);
        if (!$validator->fails()) {
            $id = $request->input('id');
            $this->boxFormat->update([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ], $id, 'id');

            $boxFormat = $this->boxFormat->find($id);
            $boxFormat->success = true;
            return $boxFormat;
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
            $this->boxFormat->update([
                'status' => 0
            ], $id, 'id');

            $boxFormat = $this->boxFormat->find($id);
            $boxFormat->success = true;
            return $boxFormat;
        } else {
            return $validator->messages();
        }
    }
}
