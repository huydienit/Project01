<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteAdx extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_site_adx';

    protected $primaryKey = 'site_id';

    protected $fillable = ['site_id', 'price_sale', 'status'];

    public function site()
    {
        return $this->hasOne('Afp\Core\App\Models\Site');
    }
}