<?php

namespace Afp\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMail extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'afp_payment_mail';

    protected $primaryKey = 'id';

    protected $fillable = ['email'];
}