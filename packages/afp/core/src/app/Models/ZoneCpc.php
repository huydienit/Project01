<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneCpc extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_zone_cpc';

    protected $primaryKey = 'zonecpc_id';

    protected $fillable = ['site_id', 'box_format_id', 'zone_template_id', 'name', 'notes', 'hidden_label', 'status'];
    public $timestamps = false;

    public function site()
    {
        return $this->belongsTo('Afp\Core\App\Models\Site', 'site_id', 'site_id');
    }

    public function boxformat()
    {
        return $this->hasOne('Afp\Core\App\Models\BoxFormat', 'box_format_id', 'id');
    }

    public function zonetemplate()
    {
        return $this->hasOne('Afp\Core\App\Models\ZoneTemplate', 'zone_template_id', 'id');
    }
}