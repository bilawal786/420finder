<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\DeliveryProducts;
use App\Models\DispenseryProduct;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /*
    *   Index
    *
    */

    public function index() {

        $slidesdesktop = [];

        if (!empty(session('latitude')) AND !empty(session('longitude'))) {

        $latitude = session('latitude');
        $longitude = session('longitude');

        $slidesdesktop = DB::table('sliders')
                  ->selectRaw("sliders.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                  ->having("distance", "<", DB::raw("slide_radius * 1000"))
                  ->orderBy("distance",'asc')
                  ->where('display_type', 'Desktop')
                  ->get();
        }

        $categories = Category::all();

        return view('products.index', [
            'slidesdesktop' => $slidesdesktop,
            'categories' => $categories
        ]);

    }

    /*
    *   Products Category
    */

    public function productsCategory($category) {

        $category = Category::where('slug', $category)->first();

        $latitude = '';
        $longitude = '';

        if (!empty(session('latitude')) AND !empty(session('longitude'))) {

            $latitude = session('latitude');
            $longitude = session('longitude');

        } else {

            $latitude = "34.0201613";
            $longitude = "-118.6919234";

        }

        $businessDelivery = Business::selectRaw("businesses.* ,
            ( 6371000 * acos( cos( radians(?) ) *
            cos( radians( latitude ) )
            * cos( radians( longitude ) - radians(?)
            ) + sin( radians(?) ) *
            sin( radians( latitude ) ) )
            ) AS distance", [$latitude, $longitude, $latitude])
           ->having("distance", "<", 250000)
           ->orderBy("distance",'asc')
           ->where('business_type', 'Delivery')->where('approve', 1)->get();

        //     $businessDispensary = Business::selectRaw("businesses.* ,
        //     ( 6371000 * acos( cos( radians(?) ) *
        //     cos( radians( latitude ) )
        //     * cos( radians( longitude ) - radians(?)
        //     ) + sin( radians(?) ) *
        //     sin( radians( latitude ) ) )
        //     ) AS distance", [$latitude, $longitude, $latitude])
        //    ->having("distance", "<", 250000)
        //    ->orderBy("distance",'asc')
        //    ->where('business_type', 'Dispensary')->get();

        $deliveryProducts = DeliveryProducts::whereIn('delivery_id', $businessDelivery->pluck('id')->toArray())
                ->where('category_id', $category->id)
               ->join('businesses', 'businesses.id', '=', 'delivery_products.delivery_id')
               ->select([
                   'delivery_products.*',
                   'businesses.profile_picture',
                   'businesses.id as business_id',
                   'businesses.business_type',
                   'businesses.business_name'
                   ])
                ->paginate(8);

        return view('products.products-category', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'category' => $category,
            'deliveryProducts' => $deliveryProducts,
        ]);

    }
}
