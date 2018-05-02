<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class PublisherSite extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'publisher_site';

    protected $connection = 'mysql2';
}