<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model {

    protected $table = 'shipping';
    protected $primaryKey = 'ship_id';
    protected $fillable = [
        'ship_name',
        'ship_description',
        'ship_image'
    ];
    protected $attributes = [
        'ship_image' => ''
    ];
    public $timestamps = false;

}
