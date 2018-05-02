<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class PublisherSiteAdxPrice extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'publisher_site_adx_price';

    protected $connection = 'mysql2';
}