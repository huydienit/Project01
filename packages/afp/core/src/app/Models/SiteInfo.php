<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_site_info';

    protected $primaryKey = 'site_id';

    protected $fillable = ['site_id', 'price_sale', 'price_buy', 'site_id', 'category_id', 'site_status', 'tag_id'];

    public function site()
    {
        return $this->hasOne('Afp\Core\App\Models\Site');
    }

    public function category()
    {
        return $this->belongsTo('Afp\Core\App\Models\SiteCategory');
    }
}