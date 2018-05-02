<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_user_info';

    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'type', 'name', 'email', 'phone', 'address', 'bank_name', 'noicap',
        'branch_name', 'stk', 'cmt', 'email_cc', 'manager_name', 'sohopdong', 'masothue', 'website', 'status'];
}