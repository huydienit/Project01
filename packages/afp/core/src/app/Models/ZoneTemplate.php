<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneTemplate extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_site_zone_template';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'code'];
}