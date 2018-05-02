<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class SiteRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\Site';
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->where('site_id', '=', $id)->first($columns);
    }
    public function getBySite($sitename, $columns = ['*'])
    {
        return $this->model->where('sitename', '=', $sitename)->first($columns);
    }
    public function getByUsername($username, $columns = ['*'])
    {
        return $this->model->with('user', 'info')
            ->whereHas('info', function ($q) {
                $q->whereIn('site_status', [0, 1, 2]);
            })
            ->where(function ($q) use ($username) {
                if ($username != '') {
                    $q->whereHas('user', function ($q) use ($username) {
                        if ($username != '')
                            $q->where('username', 'LIKE', '%' . $username . '%');
                    });
                }
            })->first($columns);
    }

    public function findAllByPaginate($attribute, $value, $limit)
    {
        $result = $this->model->where($attribute, $value)->paginate($limit);
        return $result;
    }

    public function countAll($keyword, $status, $category, $tag, $type = 1)
    {
        $result = $this->model->with('user', 'info')
            ->whereHas('info', function ($q) use ($status, $category, $tag, $type) {
                if ($type == 2) {
                    $q->where('cpc_report', 1);
                    $q->whereIn('site_status', [0, 1]);
                } elseif ($type == 1) {
                    $q->whereIn('site_status', [0, 1, 2]);
                }
                if ($status == 1)
                    $q->where('site_status', 0);
                elseif ($status == 2)
                    $q->where('site_status', 1);
                elseif ($status == 3)
                    $q->where('site_status', 2);
                if ($category > 0)
                    $q->where('category_id', $category);
                if ($tag > 0)
                    $q->where('tag_id', 'like', '%"' . $tag . '":true%');
            })
            ->where(function ($q) use ($keyword) {
                if ($keyword != '') {
                    $q->where('sitename', 'LIKE', '%' . $keyword . '%');
                    $q->orWhereHas('user', function ($q) use ($keyword) {
                        if ($keyword != '')
                            $q->where('username', 'LIKE', '%' . $keyword . '%');
                    });
                }
            })->count();
        return $result;
    }

    public function findAll($keyword, $limit, $status, $category, $tag, $type = 1)
    {
        $query = $this->model->with('user', 'info')
            ->whereHas('info', function ($q) use ($status, $category, $tag, $type) {
                if ($type == 2) {
                    $q->where('cpc_report', 1);
                    $q->whereIn('site_status', [0, 1]);
                } elseif ($type == 1) {
                    $q->whereIn('site_status', [0, 1, 2]);
                }
                if ($status == 1)
                    $q->where('site_status', 0);
                elseif ($status == 2)
                    $q->where('site_status', 1);
                elseif ($status == 3)
                    $q->where('site_status', 2);
                if ($category > 0)
                    $q->where('category_id', $category);
                if ($tag > 0)
                    $q->where('tag_id', 'like', '%"' . $tag . '":true%');
            })
            ->where(function ($q) use ($keyword) {
                if ($keyword != '') {
                    $q->where('sitename', 'LIKE', '%' . $keyword . '%');
                    $q->orWhereHas('user', function ($q) use ($keyword) {
                        if ($keyword != '')
                            $q->where('username', 'LIKE', '%' . $keyword . '%');
                    });
                }
            });

        $result = $query->orderBy('user_id')->paginate($limit);
        return $result;
    }
    public function findAllExport($keyword, $status, $category, $tag, $type = 1)
    {
        $query = $this->model->with('user', 'info')
            ->whereHas('info', function ($q) use ($status, $category, $tag, $type) {
                if ($type == 2) {
                    $q->where('cpc_report', 1);
                    $q->whereIn('site_status', [0, 1]);
                } elseif ($type == 1) {
                    $q->whereIn('site_status', [0, 1, 2]);
                }
                if ($status == 1)
                    $q->where('site_status', 0);
                elseif ($status == 2)
                    $q->where('site_status', 1);
                elseif ($status == 3)
                    $q->where('site_status', 2);
                if ($category > 0)
                    $q->where('category_id', $category);
                if ($tag > 0)
                    $q->where('tag_id', 'like', '%"' . $tag . '":true%');
            })
            ->where(function ($q) use ($keyword) {
                if ($keyword != '') {
                    $q->where('sitename', 'LIKE', '%' . $keyword . '%');
                    $q->orWhereHas('user', function ($q) use ($keyword) {
                        if ($keyword != '')
                            $q->where('username', 'LIKE', '%' . $keyword . '%');
                    });
                }
            });

        $result = $query->get();
        return $result;
    }
//    public function findAllAdx($keyword, $limit, $status=0){
//        $query = $this->model->with('user','info','adx')
//            ->whereHas('adx', function($q) use($status) {
//                if($status<3){
//                    $q->whereIn('status', [0,1]);
//                    if($status==1)
//                        $q->where('status', 0);
//                    elseif($status==2)
//                        $q->where('status', 1);
//                }
//                elseif($status==3)
//                    $q->where('status', 2);
//            })
//            ->where(function($q) use ($keyword)
//            {
//                if($keyword!=''){
//                    $q->where('sitename', 'LIKE', '%'.$keyword.'%');
//                    $q->orWhereHas('user', function($q) use($keyword) {
//                        if($keyword!='')
//                            $q->where('username', 'LIKE', '%'.$keyword.'%');
//                    });
//                }
//            });
//
//        $result = $query->paginate($limit);
//        return $result;
//    }
    public function findID($site_id)
    {
        $site = $this->model->with('user', 'info')->find($site_id);
        if (null != $site) {
            $site->id = $site->site_id;
            $site->username = $site->user->username;
            $site->price_sale = $site->info->price_sale;
            $site->price_buy = $site->info->price_buy;
            $site->category = $site->info->category_id;
            $site->visits = $site->info->visits;
            $site->pageviews = $site->info->pageviews;
            $site->rank_country = $site->info->rank_country;
            $site->tags = json_decode($site->info->tag_id);
            $site->site_status = $site->info->site_status;
            $site->statusLB = ($site->site_status == 1) ? true : false;
            $site->cpcstatus = $site->info->cpc_status;
            $site->cpcstatusLB = ($site->cpcstatus == 1) ? true : false;
            $site->cpcreport = $site->info->cpc_report;
            $site->cpcreportLB = ($site->cpcreport == 1) ? true : false;
            $site->adxstatus = $site->info->adx_status;
            $site->adxstatusLB = ($site->adxstatus == 1) ? true : false;
            $site->adxreport = $site->info->adx_report;
            $site->adxreportLB = ($site->adxreport == 1) ? true : false;
            $site->success = true;
            $site->type = 1;
        } else {
            $site = null;
        }
        return $site;
    }
//    public function findIDAdx($site_id){
//        $site = $this->model->with('user','info','adx')->find($site_id);
//        $site->id = $site->site_id;
//        $site->username = $site->user->username;
//        $site->price_sale = $site->adx->price_sale;
//        $site->category = $site->info->category_id;
//        $site->visits = $site->info->visits;
//        $site->pageviews = $site->info->pageviews;
//        $site->tags = json_decode($site->info->tag_id);
//        $site->adx_status = $site->adx->status;
//        $site->statusLB = ($site->adx_status==1)?true:false;
//        $site->cpcstatus = $site->info->cpc_status;
//        $site->cpcstatusLB = ($site->cpcstatus==1)?true:false;
//        $site->cpcreport = $site->info->cpc_report;
//        $site->cpcreportLB = ($site->cpcreport==1)?true:false;
//        $site->adxstatus = $site->info->adx_status;
//        $site->adxstatusLB = ($site->adxstatus==1)?true:false;
//        $site->adxreport = $site->info->adx_report;
//        $site->adxreportLB = ($site->adxreport==1)?true:false;
//        $site->success = true;
//        $site->type = 2;
//        return $site;
//    }
}