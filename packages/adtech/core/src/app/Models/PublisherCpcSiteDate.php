<?php

namespace Adtech\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class PublisherCpcSiteDate extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'publisher_cpc_site_date';

    protected $connection = 'mysql2';
}