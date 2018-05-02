<?php

namespace Afp\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\TagRepository;
use Afp\Core\App\Models\Tag;
use Validator;

class TagController extends Controller
{
    /**
     * @var TagRepository
     */
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        parent::__construct();
        $this->tag = $tagRepository;
    }

    public function manage(Request $request)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);

        $tagsData = $this->tag->findAllByPaginate('status', 1, $limit);
        $tags = array();
        if ($tagsData) {
            foreach ($tagsData as $k => $tag) {
                $tags[] = [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'created_at' => $tag->created_at,
                    'updated_at' => $tag->updated_at,
                ];
            }
        }
        $total = $this->tag->countAll();
        $data = [
            'jsonTagString' => json_encode($tags),
            'pageIndex' => $pageIndex,
            'total' => $total,
            'limit' => $limit,
        ];
        return view('modules.core.tag.manage', $data);
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        return $this->tag->find($id);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if (!$validator->fails()) {
            $tag = $this->tag->create([
                'name' => $request->input('name'),
                'status' => 1
            ]);
            $tag->success = true;
            return $tag;
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
            $this->tag->update([
                'name' => $request->input('name')
            ], $id, 'id');

            $tag = $this->tag->find($id);
            $tag->success = true;
            return $tag;
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
            $this->tag->update([
                'status' => 0
            ], $id, 'id');

            $tag = $this->tag->find($id);
            $tag->success = true;
            return $tag;
        } else {
            return $validator->messages();
        }
    }
}
