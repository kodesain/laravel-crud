<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model {

    const CREATED_AT = 'prod_created';
    const UPDATED_AT = 'prod_updated';

    protected $primaryKey = 'prod_id';
    protected $fillable = [
        'prod_name',
        'prod_description',
        'prod_image',
        'prod_price',
        'cat_id'
    ];
    protected $attributes = [
        'prod_image' => '',
        'prod_created' => NULL,
        'prod_updated' => NULL
    ];
    public $timestamps = false;

    public static function boot() {
        parent::boot();

        self::creating(function($model) {
            $model->prod_created = date('Y-m-d H:i:s');
        });

        self::updating(function($model) {
            $model->prod_updated = date('Y-m-d H:i:s');
        });
    }

}
