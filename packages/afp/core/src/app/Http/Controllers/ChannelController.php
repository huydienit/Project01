<?php

namespace Afp\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\ChannelRepository;
use Validator;

class ChannelController extends Controller
{
    /**
     * @var ChannelRepository
     */
    private $channelRepository;

    public function __construct(ChannelRepository $channelRepository)
    {
        parent::__construct();
        $this->channel = $channelRepository;
    }

    public function manage(Request $request)
    {
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);

        $channelsData = $this->channel->findAllByPaginate($limit);
        $channels = array();
        if ($channelsData) {
            foreach ($channelsData as $k => $channel) {
                $channels[] = [
                    'id' => $channel->channelid,
                    'name' => $channel->name,
                    'created_at' => $channel->created_at,
                    'updated_at' => $channel->updated_at,
                ];
            }
        }
        $total = $this->channel->countAll();
        $data = [
            'jsonchannelString' => json_encode($channels),
            'pageIndex' => $pageIndex,
            'total' => $total,
            'limit' => $limit,
        ];
        return view('modules.core.channel.manage', $data);
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        $data = $this->channel->find($id);
        $data->id = $data->channelid;
        return $data;
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if (!$validator->fails()) {
            $channel = $this->channel->create([
                'name' => $request->input('name')
            ]);
            $channel->id = $channel->channelid;
            $channel->success = true;
            return $channel;
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
            $this->channel->update([
                'name' => $request->input('name')
            ], $id, 'channelid');

            $channel = $this->channel->find($id);
            $channel->id = $channel->channelid;
            $channel->success = true;
            return $channel;
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
            $this->channel->update([
                'status' => 0
            ], $id, 'channelid');
            return ['success' => true];
        } else {
            return $validator->messages();
        }
    }
}
