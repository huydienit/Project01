<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_province';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'code', 'code_new'];
}