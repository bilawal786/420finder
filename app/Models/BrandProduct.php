<?php

namespace App\Models;

use App\Models\Traits\CanBeScoped;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandProduct extends Model
{
    use HasFactory;

    public function brand() {

        return $this->belongsTo('App\Models\Brand');

    }


    public function reviews() {

        return $this->hasMany('App\Models\BrandProductReview');

    }

    public function gallery() {

        return $this->hasMany('App\Models\BrandProductGallery');

    }

}
