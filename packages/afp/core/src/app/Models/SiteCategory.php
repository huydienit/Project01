<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteCategory extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_site_category';

    protected $primaryKey = 'category_id';

    protected $fillable = ['name'];
}