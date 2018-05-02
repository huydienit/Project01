<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneAdx extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_zone_adx';

    protected $primaryKey = 'zoneadx_id';

    protected $fillable = ['site_id', 'box_format_id', 'zone_template_id', 'name',
        'notes', 'hidden_label', 'status', 'is_banner_default', 'tansuat_hthi'];
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

    public function channel()
    {
        return $this->hasOne('Afp\Core\App\Models\Channel', 'channel', 'id');
    }
}