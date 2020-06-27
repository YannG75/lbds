<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actu extends Model
{
    protected $fillable = ['title','image', 'content','summary','author','publish_date','is_published'];
}
