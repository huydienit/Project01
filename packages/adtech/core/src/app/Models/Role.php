<?php

namespace Adtech\Core\App\Models;

use Illuminate\Database\Eloquent\Model;
use \Adtech\Application\Cms\Libraries\Acl as AdtechAcl;
use Validator;

class Role extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'adtech_core_roles';

    protected $primaryKey = 'role_id';

    protected $fillable = ['name'];

    public function canAccess($routeName, $params = null)
    {
        return AdtechAcl::getInstance()->isAllow($routeName, $params, $this);
    }
}