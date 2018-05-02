<?php

namespace Afp\Core\App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Afp\Core\App\Repositories\SiteRepository;
use Afp\Core\App\Repositories\SiteAdxRepository;
use Afp\Core\App\Repositories\SiteInfoRepository;
use Afp\Core\App\Repositories\SiteCategoryRespository;
use Afp\Core\App\Repositories\TagRepository;
use Adtech\Core\App\Repositories\UserRepository;
use Afp\Core\App\Repositories\ZoneCpcRepository;
use Auth;

class SiteController extends Controller
{
    /**
     * @var SiteCategoryRespository
     * @var SiteRepository
     * @var SiteInfoRepository
     * @var SiteAdxRepository
     * @var TagRepository
     * @var UserRepository
     * @var ZoneCpcRepository
     */
    private $siteCategoryRepository;
    private $siteRepository;
    private $siteAdxRepository;
    private $siteInfoRepository;
    private $tagRepository;
    private $userRepository;
    private $zoneCpcRepository;

    private $messages = array(
        'required' => "Bắt buộc",
        'email' => "Email không chính xác",
        'unique' => "Đã tồn tại email/username",
        'regex' => "Sai định dạng",
        'max' => "Chuỗi quá dài",
        'min' => "Chuỗi quá ngắn",
        'boolean' => "Sai định dạng",
        'confirmed' => "Xác nhận không chính xác",
        'numeric' => "Yêu cầu là số",
    );

    public function __construct(SiteCategoryRespository $siteCategoryRepository,
                                SiteRepository $siteRepository,
                                SiteAdxRepository $siteAdxRepository,
                                SiteInfoRepository $siteInfoRepository,
                                ZoneCpcRepository $zoneCpcRepository,
                                UserRepository $userRepository,
                                TagRepository $tagRepository)
    {
        parent::__construct();
        $this->siteCategory = $siteCategoryRepository;
        $this->siteInfo = $siteInfoRepository;
        $this->siteAdx = $siteAdxRepository;
        $this->zoneCpc = $zoneCpcRepository;
        $this->site = $siteRepository;
        $this->user = $userRepository;
        $this->tag = $tagRepository;
    }

    public function index(Request $request)
    {
        $category = (int)$request->input('category', 0);
        $keyword = trim($request->input('keyword', ''));
        $pageIndex = (int)$request->input('page', 1);
        $limit = (int)$request->input('limit', 30);
        $status = (int)$request->input('status', 0);
        $type = (int)$request->input('type', 0);
        $tag = (int)$request->input('tag', 0);
        $edit = (int)$request->input('edit', 0);
        $site_id = (int)$request->input('site_id', 0);

        $typeList = [0 => ['id' => 1, 'name' => 'CPC'], 1 => ['id' => 2, 'name' => 'ADX']];
        $statusList = [0 => ['id' => 1, 'name' => 'off'], 1 => ['id' => 2, 'name' => 'on'], 2 => ['id' => 3, 'name' => 'register']];

        $siteList = $siteEmpty = [];
        $total = $this->site->countAll($keyword, $status, $category, $tag, 1);
        $siteData = $this->site->findAll($keyword, $limit, $status, $category, $tag);
        if ($siteData && count($siteData) > 0) {
            foreach ($siteData as $k => $site) {
                $siteList[] = [
                    'id' => $site->site_id,
                    'site_id' => $site->site_id,
                    'sitename' => $site->sitename,
                    'username' => $site->user->username,
                    'slzone' => $this->zoneCpc->countAll($site->site_id),
                    'visits' => $site->info->visits,
                    'pageviews' => $site->info->pageviews,
                    'rank_country' => $site->info->rank_country,
                    'type' => 1,
                    'site_status' => $site->info->site_status,
                    'statusLB' => ($site->info->site_status == 1) ? true : false,
                    'zonedetailurl' => route('afp.core.zone-cpc.manage', [
                        'site_id' => $site->site_id,
                    ])
                ];
            }
        }

        if (count($siteList) == 0) {
            $siteEmpty[] = [
                'name' => trans('afp-core::labels.empty')
            ];
        }
        $categoryList = $this->siteCategory->findAll('status', 1);
        $tagList = $this->tag->findAll('status', 1);
        $data = [
            'jsonSiteEmptyString' => json_encode($siteEmpty),
            'jsonSiteString' => json_encode($siteList),
            'categoryList' => json_encode($categoryList),
            'tagList' => json_encode($tagList),
            'pageIndex' => $pageIndex,
            'keyword' => $keyword,
            'limit' => $limit,
            'status' => $status,
            'type' => $type,
            'total' => $total,
            'tag' => $tag,
            'edit' => $edit,
            'site_id' => $site_id,
            'category' => $category,
            'typeList' => json_encode($typeList),
            'statusList' => json_encode($statusList)
        ];
        return view('modules.core.site.manage', $data);
    }

    public function show(Request $request)
    {
        $site_id = $request->input('site_id');
        $siteData = $this->site->findID($site_id);

        $url = $siteData->sitename;
        $xml = simplexml_load_file('http://data.alexa.com/data?cli=10&dat=snbamz&url=' . $url);
        $rank = isset($xml->SD[1]->COUNTRY) ? $xml->SD[1]->COUNTRY->attributes()->RANK : 0;
        $siteData->rank_country = ($siteData->rank_country > 0) ? $siteData->rank_country : (int)$rank;

        return $siteData;
    }

    public function getSitename(Request $request)
    {
        $siteData = null;
        $validator = Validator::make($request->all(), [
            'sitename' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $sitename = $request->input('sitename');
            if ($this->is_valid_domain_name($sitename)) {
                $siteData = $this->site->getBySite($sitename);
                if (null != $siteData) {
                    $siteData->success = true;
                }
            }
        }
        return $siteData;
    }

    public function getUsername(Request $request)
    {
        $siteData = null;
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:191|min:2|regex:/^[A-Za-z0-9]+$/i',
        ], $this->messages);
        if (!$validator->fails()) {
            $username = $request->input('username');
            $siteData = $this->site->getByUsername($username);
            if (null != $siteData) {
                $siteData->success = true;
            }
        }
        return $siteData;
    }

    public function is_valid_domain_name($domain_name)
    {
        return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
            && preg_match("/^.{1,253}$/", $domain_name) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)); //length of each label
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'price_buy' => 'required|numeric',
            'price_sale' => 'required|numeric',
            'visits' => 'numeric',
            'pageviews' => 'numeric',
            'rank_country' => 'numeric',
            'sitename' => 'required|unique:afp_site',
            'status' => 'boolean',
            'username' => 'required'
        ], $this->messages);
        $validator_fails = Validator::make($request->all(), [
            'username' => 'unique:adtech_core_users'
        ], $this->messages);
        if ($this->is_valid_domain_name($request->input('sitename'))) {
            return 'Sitename không tồn tại!';
        } elseif (!$validator->fails() && $validator_fails->fails()) {
            $userDetail = $this->user->getByUsername($request->input('username'));
            if (null != $userDetail) {
                $site = $this->site->create([
                    'user_id' => $userDetail->user_id,
                    'sitename' => $request->input('sitename')
                ]);
                $siteInfo = $this->siteInfo->create([
                    'site_id' => $site->site_id,
                    'category_id' => $request->input('category_id'),
                    'price_sale' => $request->input('price_sale'),
                    'price_buy' => $request->input('price_buy'),
                    'visits' => $request->input('visits'),
                    'pageviews' => $request->input('pageviews'),
                    'rank_country' => $request->input('rank_country'),
                    'site_status' => ($request->input('status')) ? 1 : 0,
                    'tag_id' => json_encode($request->input('tag')),
                ]);
                $siteData = $this->site->findID($site->site_id);
                return $siteData;
            } else {
                return 'Không tồn tại tài khoản!';
            }
        } elseif ($validator->fails()) {
            return $validator->messages();
        } elseif (!$validator_fails->fails()) {
            return 'Không tồn tại tài khoản!';
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'price_buy' => 'required|numeric',
            'price_sale' => 'required|numeric',
            'visits' => 'numeric',
            'pageviews' => 'numeric',
            'rank_country' => 'numeric',
            'status' => 'boolean',
        ], $this->messages);
        if (!$validator->fails()) {
            $this->siteInfo->update([
                'category_id' => $request->input('category_id'),
                'price_buy' => $request->input('price_buy'),
                'price_sale' => $request->input('price_sale'),
                'visits' => $request->input('visits'),
                'pageviews' => $request->input('pageviews'),
                'rank_country' => $request->input('rank_country'),
                'site_status' => ($request->input('status')) ? 1 : 0,
                'cpc_status' => ($request->input('cpcstatus')) ? 1 : 0,
                'cpc_report' => ($request->input('cpcreport')) ? 1 : 0,
                'tag_id' => json_encode($request->input('tag')),
            ], $request->input('site_id'), 'site_id');
            $siteData = $this->site->findID($request->input('site_id'));
            return $siteData;
        } else {
            return $validator->messages();
        }
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => 'required|numeric'
        ], $this->messages);
        if (!$validator->fails()) {
            $this->siteInfo->update([
                'site_status' => -1,
            ], $request->input('site_id'), 'site_id');

            $siteData = $this->site->findID($request->input('site_id'));
            return $siteData;
        } else {
            return $validator->messages();
        }
    }

    public function status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => 'required|numeric',
            'site_status' => 'required|boolean',
        ], $this->messages);
        if (!$validator->fails()) {
            $this->siteInfo->update([
                'site_status' => ($request->input('site_status')) ? 1 : 0,
            ], $request->input('site_id'), 'site_id');

            $siteData = $this->site->findID($request->input('site_id'));
            return $siteData;
        } else {
            return $validator->messages();
        }
    }
}