<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_report';

    protected $primaryKey = 'id';

    protected $fillable = ['zonecpc_id', 'site_id', 'totalclick', 'realclick', 'pageview', 'impression', 'date', 'money', 'price'];

    public function site()
    {
        return $this->hasOne('Afp\Core\App\Models\Site', 'site_id', 'site_id');
    }

    public function zone()
    {
        return $this->belongsTo('Afp\Core\App\Models\ZoneCpc', 'zonecpc_id', 'zonecpc_id');
    }
}