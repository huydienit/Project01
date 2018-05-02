<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_site';

    protected $primaryKey = 'site_id';

    protected $fillable = ['sitename', 'user_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('Adtech\Core\App\Models\User', 'user_id', 'user_id');
    }

    public function info()
    {
        return $this->hasOne('Afp\Core\App\Models\SiteInfo', 'site_id', 'site_id');
    }

    public function adx()
    {
        return $this->hasOne('Afp\Core\App\Models\SiteAdx', 'site_id', 'site_id');
    }
}