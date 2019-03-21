<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {

    protected $primaryKey = 'cat_id';
    protected $fillable = [
        'cat_name',
        'cat_description'
    ];
    public $timestamps = false;

}
