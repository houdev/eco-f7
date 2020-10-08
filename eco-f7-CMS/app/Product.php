<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function productGallery(){
        return $this->hasMany('App\ProductGallery');
    }

    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function cart(){
        return $this->belongsTo('App\Cart');
    }
}
