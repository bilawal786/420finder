<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class MapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "phone_number" => $this->phone_number,
            "email" => $this->email,
            "role" => $this->role,
            "profile_picture" => $this->profile_picture,
            "business_name" => $this->business_name,
            "business_type" => $this->business_type,
            "country" => $this->country,
            "address_line_1" => $this->address_line_1,
            "address_line_2" => $this->address_line_2,
            "city" => $this->city,
            "state_province" => $this->state_province,
            "postal_code" => $this->postal_code,
            "opening_time" => $this->opening_time,
            "closing_time" => $this->closing_time,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "website" => $this->website,
            "instagram" => $this->instagram,
            "license_number" => $this->license_number,
            "license_type" => $this->license_type,
            "license_expiration" => $this->license_expiration,
            "order_online" => $this->order_online,
            "delivery" => $this->delivery,
            "status" => $this->status,
            "top_business" => $this->top_business,
            "order" => $this->order,
            "icon" => $this->icon,
            "distance" => $this->distance,
            "route" => URL::to('/'),
            "reviewCount" => $this->reviewCount,
            "rating" => $this->rating,
            'custom_icon' => $this->custom_icon
        ];
    }
}
