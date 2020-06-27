<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','image', 'price','description','color','release_date','brand','brand_id','actif'];
    public function images() {

        return $this->hasMany('App\Image', 'sneaker_id', 'id');
    }
}
