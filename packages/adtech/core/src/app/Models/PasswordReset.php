<?php

namespace Adtech\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'adtech_password_resets';

    protected $fillable = ['email', 'token', 'created_at'];
}
