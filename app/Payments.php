<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model {

    protected $primaryKey = 'pay_id';
    protected $fillable = [
        'pay_name',
        'pay_description'
    ];
    public $timestamps = false;

}
