<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_payment';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'site_id', 'begin', 'end', 'money', 'status'];

    public $timestamps = false;

    public function site()
    {
        return $this->hasOne('Afp\Core\App\Models\Site', 'site_id', 'site_id');
    }

    public function zone()
    {
        return $this->belongsTo('Adtech\Core\App\Models\User', 'user_id', 'user_id');
    }
}