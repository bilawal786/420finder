<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Traits\CanBeScoped;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryProducts extends Model
{
    use HasFactory, CanBeScoped;


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(RetailerReview::class, 'product_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'delivery_id');
    }
}
