<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class BoxFormat extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_site_box_format';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'description'];
}