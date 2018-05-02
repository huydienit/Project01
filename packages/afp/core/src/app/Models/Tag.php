<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_site_tag';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];
}