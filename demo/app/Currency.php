<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    //
    const ALLOWED_CURRENCY = [
        'TWD',
        'USD',
        'JPY',
        'RMB',
        'MYR',
    ];
}
