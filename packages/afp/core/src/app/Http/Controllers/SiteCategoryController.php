<?php

namespace Afp\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\SiteCategoryRespository;
use Afp\Core\App\Models\SiteCategory;
use Validator;

class SiteCategoryController extends Controller
{
    /**
     * @var SiteCategoryRespository
     */
    private $siteCategoryRepository;

    public function __construct(SiteCategoryRespository $siteCategoryRepository)
    {
        parent::__construct();
        $this->siteCategory = $siteCategoryRepository;
    }

    public function manage(Request $request)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);

        $categoryData = $this->siteCategory->findAllByPaginate('status', 1, $limit);
        $categories = array();
        if ($categoryData) {
            foreach ($categoryData as $k => $category) {
                $categories[] = [
                    'id' => $category->category_id,
                    'name' => $category->name,
                    'created_at' => $category->created_at,
                    'updated_at' => $category->updated_at,
                ];
            }
        }
        $total = $this->siteCategory->countAll();
        $data = [
            'jsonCategoryString' => json_encode($categories),
            'pageIndex' => $pageIndex,
            'limit' => $limit,
            'total' => $total,
        ];
        return view('modules.core.category.manage', $data);
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        $category = $this->siteCategory->find($id);
        $category->id = $category->category_id;
        return $category;
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if (!$validator->fails()) {
            $category = $this->siteCategory->create([
                'name' => $request->input('name'),
                'status' => 1
            ]);
            $category->success = true;
            $category->id = $category->category_id;
            return $category;
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
            $this->siteCategory->update([
                'name' => $request->input('name')
            ], $id, 'category_id');

            $category = $this->siteCategory->find($id);
            $category->id = $category->category_id;
            $category->success = true;
            return $category;
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
            $this->siteCategory->update([
                'status' => 0
            ], $id, 'category_id');

            $category = $this->siteCategory->find($id);
            $category->id = $category->category_id;
            $category->success = true;
            return $category;
        } else {
            return $validator->messages();
        }
    }
}
