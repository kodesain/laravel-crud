<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model {

    protected $primaryKey = 'ship_id';
    protected $fillable = [
        'ship_name',
        'ship_description'
    ];
    public $timestamps = false;

}
