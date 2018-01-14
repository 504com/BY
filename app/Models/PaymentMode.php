<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    const PAYPAL = 1;
    const CREDIT_CARD = 2;
    const CASH = 3;

    protected $table = 'payments_modes';
}
