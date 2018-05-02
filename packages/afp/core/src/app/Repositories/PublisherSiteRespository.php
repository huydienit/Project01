<?php

namespace Afp\Core\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

class PublisherSiteRespository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Afp\Core\App\Models\PublisherSite';
    }

    public function getSiteDetail($domain)
    {
        $SiteDetail = DB::connection('mysql2')->table('reportingdb.selfserving_price AS A')
            ->join('reportingdb.publisher_site AS B', 'A.name', '=', 'B.sitename')
            ->join('publisher.publisher_site_price AS C', 'C.siteId', '=', 'B.siteId')
            ->select('A.price AS price_sale', 'C.money AS price_buy', 'B.sitename AS name')
            ->where([
                ['B.sitename', $domain],
                ['A.siteid', '>', 0],
                ['C.formatId', 0],
            ])->first();

        return $SiteDetail;
    }

    public function getListCategory()
    {
        $SiteDetail = DB::connection('mysql2')->table('reportingdb.self_serving_categories AS A')
            ->select('A.*')
            ->where([
                ['A.type', 1]
            ])->get();

        return $SiteDetail;
    }

    public function getListTag()
    {
        $SiteDetail = DB::connection('mysql2')->table('reportingdb.adm_tag AS A')
            ->select('A.*')
            ->where([
                ['A.tag_status', 1],
                ['A.typead', 1],
            ])->get();

        return $SiteDetail;
    }
}