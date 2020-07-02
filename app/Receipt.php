<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{

    protected $guarded = [];
    protected $primaryKey = 'receipt_id';
    protected $dates = ['receipt_opened_date'];

}
