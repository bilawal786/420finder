<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Api\DetailsController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\MenuReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/products/search', [ProductController::class, 'searchNavProducts']);


Route::get('/products', [ProductController::class, 'index']);
Route::get('/featured-products', [ProductController::class, 'getFeaturedProducts']);

Route::get('/products/get-categories/{id}', [ProductController::class, 'getCategories']);
Route::get('/products/get-brand/{id}', [ProductController::class, 'getBrand']);
Route::get('/products/get-strains/{id}', [ProductController::class, 'getStrains']);
Route::get('/products/get-genetics/{id}', [ProductController::class, 'getGenetics']);

Route::get('/products/get-cannabs/{id}', [ProductController::class, 'getCannabs']);


Route::get('/products/search-brand/{id}/{search}', [ProductController::class, 'searchBrand']);

// Products Category
Route::get("/products/category", [ProductController::class, 'productsCategory']);

// ======================= DESKTOP MAP ==============================

Route::get('/map', [MapController::class, 'map']);

Route::get('/map/categories', [MapController::class, 'categories']);

// GET RETAILER DETAILS
Route::get('/map/get-retailer-details/{id}', [MapController::class, 'getRetailerDetails']);

// GET RETAILER REVIEWS
Route::get('/map/get-retailer-reviews/{id}', [MapController::class, 'getRetailerReviews']);

// GET ALL SOTRES
Route::get('/map/get-all-stores/{lat}/{lng}', [MapController::class, 'getAllStores']);

// RETAILER MENU REVIEWS
Route::get('/menu/get-retailer-reviews/{id}', [MenuReviewController::class, 'getRetailerReviews']);

Route::get('/menu/get-product-reviews/{retailerId}/{productId}', [MenuReviewController::class, 'getProductReviews']);

Route::get('/delivery/details/map', [DetailsController::class, 'index']);
