<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_site_channel';

    protected $primaryKey = 'channelid';

    protected $fillable = ['name'];
}