<?php

namespace App\Models;

use App\Models\Deal;
use App\Models\Detail;
use App\Models\RetailerReview;
use App\Models\Traits\CanBeScoped;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
    use HasFactory, CanBeScoped;

    public function brands() {

        return $this->hasMany('App\Models\Brand');

    }

    public function detail() {

        return $this->hasOne(Detail::class);

    }

    public function reviews() {

        return $this->hasMany(RetailerReview::class, 'retailer_id');

    }

    public function deals() {

        return $this->hasMany(Deal::class, 'retailer_id');

    }

    public function deliveryProducts() {
        return $this->hasMany(DeliveryProducts::class, 'id');
    }

    public function dispensaryProducts() {
        return $this->hasMany(DispenseryProduct::class, 'id');
    }

}
