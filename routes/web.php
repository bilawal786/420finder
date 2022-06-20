<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' =>'App\Http\Controllers' ], function() {

    Route::get('/', [

        'uses' => 'WebsiteController@index',
        'as' => 'index'

    ]);

    Route::get('/manage-my-business', [

        'uses' => 'WebsiteController@managemybusiness',
        'as' => 'managemybusiness'

    ]);

    Route::get('/manage-customer-account', [

        'uses' => 'WebsiteController@managecustomeraccount',
        'as' => 'managecustomeraccount'

    ]);

    Route::get('/search', [

        'uses' => 'WebsiteController@search',
        'as' => 'search'

    ]);

    Route::post('/getlocationforcurrentuser', [

        'uses' => 'WebsiteController@getlocationforcurrentuser',
        'as' => 'getlocationforcurrentuser'

    ]);

    // Route::get('/old-maps', [

    //     'uses' => 'WebsiteController@maps',
    //     'as' => 'maps'
    // ]);

    // Route::get('/desktop-map', [

    //     'uses' => 'WebsiteController@desktopMap',
    //     'as' => 'desktop-map'
    // ]);

    Route::get('/maps', [

        'uses' => 'WebsiteController@desktopMap',
        'as' => 'desktop-map'
    ]);


    Route::post('/getbusinessdetails', [

        'uses' => 'WebsiteController@getbusinessdetails',
        'as' => 'getbusinessdetails'

    ]);

    Route::get('/deals', [

        'uses' => 'WebsiteController@deals',
        'as' => 'deals'

    ]);

    Route::get('/map/filter/{keyword}', [

        'uses' => 'WebsiteController@mapfilter',
        'as' => 'mapfilter'

    ]);

    Route::get('/dispensaries', [

        'uses' => 'WebsiteController@dispensaries',
        'as' => 'dispensaries'

    ]);

    Route::get('/deliveries', [

        'uses' => 'WebsiteController@deliveries',
        'as' => 'deliveries'

    ]);

    Route::get('/dispensaries/{name}/{id}', [

        'uses' => 'WebsiteController@dispensarysingle',
        'as' => 'dispensarysingle'

    ]);

    Route::get('/dispensaries/{name}/{id}/category/{category}', [

        'uses' => 'WebsiteController@dispensarysinglecategory',
        'as' => 'dispensarysinglecategory'

    ]);

    Route::get('/dispensaries/{name}/{id}/sub-category/{subcategory}', [

        'uses' => 'WebsiteController@dispensarysinglesubcategory',
        'as' => 'dispensarysinglesubcategory'

    ]);

    Route::get('/retailer/{business_type}/product/{slug}/{product_id}', [

        'uses' => 'WebsiteController@retailerproduct',
        'as' => 'retailerproduct'

    ]);

    Route::get('/deliveries/{name}/{id}', [

        'uses' => 'WebsiteController@deliverysingle',
        'as' => 'deliverysingle'

    ]);

    Route::get('/deliveries/{name}/{id}/category/{category}', [

        'uses' => 'WebsiteController@deliverysinglecategory',
        'as' => 'deliverysinglecategory'

    ]);

    Route::get('/deliveries/{name}/{id}/sub-category/{subcategory}', [

        'uses' => 'WebsiteController@deliverysinglesubcategory',
        'as' => 'deliverysinglesubcategory'

    ]);

    Route::post('/addtocartdispensary', [

        'uses' => 'WebsiteController@addtocartdispensary',
        'as' => 'addtocartdispensary'

    ]);

    Route::post('/removedcartadddispansory', [

        'uses' => 'WebsiteController@removedcartadddispansory',
        'as' => 'removedcartadddispansory'

    ]);

    Route::post('/addtocartdelivery', [

        'uses' => 'WebsiteController@addtocartdelivery',
        'as' => 'addtocartdelivery'

    ]);

    Route::post('/removedcartadddelivery', [

        'uses' => 'WebsiteController@removedcartadddelivery',
        'as' => 'removedcartadddelivery'

    ]);

    Route::get('/strains', [

        'uses' => 'WebsiteController@strains',
        'as' => 'strains'

    ]);

    Route::get('/strain/{id}', [

        'uses' => 'WebsiteController@strainsingle',
        'as' => 'strainsingle'

    ]);

    Route::get('/strains/search', [

        'uses' => 'WebsiteController@searchstrain',
        'as' => 'searchstrain'

    ]);

    Route::get('/categories', [

        'uses' => 'WebsiteController@categories',
        'as' => 'categories'

    ]);

    Route::post('/gettypesubcategories', [

        'uses' => 'WebsiteController@gettypesubcategories',
        'as' => 'gettypesubcategories'

    ]);

    Route::post('/getparentchildsubcat', [

        'uses' => 'WebsiteController@getparentchildsubcat',
        'as' => 'getparentchildsubcat'

    ]);

    Route::get('/search/{catname}', [

        'uses' => 'WebsiteController@categorywisewise',
        'as' => 'categorywisewise'

    ]);

    Route::get('/signin', [

        'uses' => 'WebsiteController@signin',
        'as' => 'signin'

    ]);

    Route::get('/signup', [

        'uses' => 'WebsiteController@signup',
        'as' => 'signup'

    ]);

    Route::get('/forgot-password', [

        'uses' => 'WebsiteController@forgotpassword',
        'as' => 'forgotpassword'

    ]);

    Route::get('/cart', [

        'uses' => 'WebsiteController@cart',
        'as' => 'cart'

    ]);



    // Ajax Call
    Route::post('/favoritebrand', [

        'uses' => 'WebsiteController@favoritebrand',
        'as' => 'favoritebrand'

    ]);

    // Ajax Call
    Route::post('/favbrandproduct', [

        'uses' => 'WebsiteController@favbrandproduct',
        'as' => 'favbrandproduct'

    ]);

    // Ajax Call
    Route::post('/favdispensary', [

        'uses' => 'WebsiteController@favdispensary',
        'as' => 'favdispensary'

    ]);

    // Ajax Call
    Route::post('/favretailerproduct', [

        'uses' => 'WebsiteController@favretailerproduct',
        'as' => 'favretailerproduct'

    ]);

    // Ajax Call
    Route::post('/favdelivery', [

        'uses' => 'WebsiteController@favdelivery',
        'as' => 'favdelivery'

    ]);

    Route::get('/checkout', [

        'uses' => 'StripeController@checkout',
        'as' => 'checkout'

    ]);

    Route::post('/stripe', [

        'uses' => 'StripeController@stripePost',
        'as' => 'stripe.post'

    ]);

    Route::get('/stripe/approval', [
        'uses' => 'StripeController@stripeApproval',
        'as' => 'stripe.approval'
    ]);

    Route::get('/paypal/cancel', [
        'uses' => 'StripeController@paypalCancelled',
        'as' => 'paypal.cancelled'
    ]);

    Route::get('/cart/remove/{id}', [

        'uses' => 'WebsiteController@deletedeliverycartitem',
        'as' => 'deletedeliverycartitem'

    ]);

    Route::get('/notifications', [

        'uses' => 'WebsiteController@notifications',
        'as' => 'notifications'

    ]);

    Route::get('/add-a-business', [

        'uses' => 'WebsiteController@addabusiness',
        'as' => 'addabusiness'

    ]);

    Route::post('/save-a-business', [

        'uses' => 'WebsiteController@saveabusiness',
        'as' => 'saveabusiness'

    ]);

    Route::get('/business-submitted', [

        'uses' => 'WebsiteController@businesssubmitted',
        'as' => 'businesssubmitted'

    ]);

    Route::get('/profile', [

        'uses' => 'DashboardController@profile',
        'as' => 'profile'

    ]);

    Route::get('/logout', [

        'uses' => 'CustomerAuthController@logout',
        'as' => 'logout'

    ]);

    Route::get('/profile/order-history', [

        'uses' => 'DashboardController@orderhistory',
        'as' => 'orderhistory'

    ]);

    Route::get('/profile/order-history/{tracking_number}', [

        'uses' => 'DashboardController@orderdetails',
        'as' => 'orderdetails'

    ]);

    Route::get('/favorites', [

        'uses' => 'WebsiteController@favorites',
        'as' => 'favorites'

    ]);

    Route::get('/profile/recently-viewed', [

        'uses' => 'DashboardController@recentlyviewed',
        'as' => 'recentlyviewed'

    ]);

    Route::get('/profile/recently-viewed/{id}', [

        'uses' => 'DashboardController@removerecentproduct',
        'as' => 'removerecentproduct'

    ]);

    Route::get('/deals-claimed', [

        'uses' => 'DashboardController@dealsclaimed',
        'as' => 'dealsclaimed'

    ]);

    Route::get('/profile/my-reviews', [

        'uses' => 'DashboardController@myreviews',
        'as' => 'myreviews'

    ]);

    Route::get('/profile/my-reviews/delete/{id}', [

        'uses' => 'DashboardController@removereview',
        'as' => 'removereview'

    ]);

    Route::get('/profile/account-settings', [

        'uses' => 'DashboardController@accountsettings',
        'as' => 'accountsettings'

    ]);

    Route::post('/savename', [

        'uses' => 'DashboardController@savename',
        'as' => 'savename'

    ]);

    Route::post('/savephonenumber', [

        'uses' => 'DashboardController@savephonenumber',
        'as' => 'savephonenumber'

    ]);

    Route::post('/savedateofbirth', [

        'uses' => 'DashboardController@savedateofbirth',
        'as' => 'savedateofbirth'

    ]);

    Route::post('/savedeliveryaddress', [

        'uses' => 'DashboardController@savedeliveryaddress',
        'as' => 'savedeliveryaddress'

    ]);

    Route::post('/saveabout', [

        'uses' => 'DashboardController@saveabout',
        'as' => 'saveabout'

    ]);

    Route::post('/saveprofilepicture', [

        'uses' => 'DashboardController@saveprofilepicture',
        'as' => 'saveprofilepicture'

    ]);

    // CustomerAuthController

    Route::post('/check-signin', [

        'uses' => 'CustomerAuthController@checksignin',
        'as' => 'checksignin'

    ]);

    Route::post('/account-signup', [

        'uses' => 'CustomerAuthController@accountsignup',
        'as' => 'accountsignup'

    ]);

    Route::get('/business-signin', [

        'uses' => 'BusinessController@businesssignin',
        'as' => 'businesssignin'

    ]);

    Route::post('/business-authentication', [

        'uses' => 'BusinessController@authenticate',
        'as' => 'authenticate'

    ]);

    Route::get('/business/profile', [

        'uses' => 'BusinessController@businessprofile',
        'as' => 'businessprofile'

    ]);

    Route::get('/business/account-settings', [

        'uses' => 'BusinessController@businessaccountsettings',
        'as' => 'businessaccountsettings'

    ]);

    Route::post('/updatefirstname', [

        'uses' => 'BusinessController@updatefirstname',
        'as' => 'updatefirstname'

    ]);

    Route::post('/updatelastname', [

        'uses' => 'BusinessController@updatelastname',
        'as' => 'updatelastname'

    ]);

    Route::post('/updatephonenumber', [

        'uses' => 'BusinessController@updatephonenumber',
        'as' => 'updatephonenumber'

    ]);

    Route::post('/updatebusinessname', [

        'uses' => 'BusinessController@updatebusinessname',
        'as' => 'updatebusinessname'

    ]);

    Route::post('/updateaddresslineone', [

        'uses' => 'BusinessController@updateaddresslineone',
        'as' => 'updateaddresslineone'

    ]);

    Route::post('/updateaddresslinetwo', [

        'uses' => 'BusinessController@updateaddresslinetwo',
        'as' => 'updateaddresslinetwo'

    ]);

    Route::post('/updatewebsite', [

        'uses' => 'BusinessController@updatewebsite',
        'as' => 'updatewebsite'

    ]);

    Route::get('/business-logout', [

        'uses' => 'BusinessController@businesslogout',
        'as' => 'businesslogout'

    ]);

    // Brands

    Route::get('/dashboard/brands', [

        'uses' => 'BrandController@index',
        'as' => 'dashboardbrands'

    ]);

    Route::get('/brands/create', [

        'uses' => 'BrandController@create',
        'as' => 'dashboardbrandscreate'

    ]);

    Route::post('/brands/crete/save', [

        'uses' => 'BrandController@save',
        'as' => 'savebrand'

    ]);

    Route::get('/brands/edit/{id}', [

        'uses' => 'BrandController@edit',
        'as' => 'eidtdashboardbrand'

    ]);

    Route::post('/brands/update', [

        'uses' => 'BrandController@update',
        'as' => 'updatebrand'

    ]);

    Route::get('/brand/{id}', [

        'uses' => 'BrandController@view',
        'as' => 'viewprofilebrand'

    ]);

    Route::get('/brand/{slug}/{id}/payment', [

        'uses' => 'BrandController@brandPayments',
        'as' => 'managebrandpayments'
    ]);

    // STORE BRAND PAYMENT
    Route::post('/brand/payment', [
        'uses' => 'BrandController@storeBrandPayment',
        'as' => 'storebrandpayment'
    ]);

    Route::get('/brand/{slug}/products/{id}', [

        'uses' => 'BrandController@products',
        'as' => 'managebrandproducts'

    ]);

    Route::get('/brands/{slug}/feeds/{id}', [

        'uses' => 'BrandController@viewbrandfeeds',
        'as' => 'viewbrandfeeds'

    ]);

    Route::post('/brands/feed/save', [

        'uses' => 'BrandController@savebrandfeed',
        'as' => 'savebrandfeed'

    ]);

    Route::get('/brands/feed/remove/{id}', [

        'uses' => 'BrandController@removebrandfeed',
        'as' => 'removebrandfeed'

    ]);

    Route::post('/getfeedsingle', [

        'uses' => 'BrandController@getfeedsingle',
        'as' => 'getfeedsingle'

    ]);

    Route::post('/brands/feeds/update', [

        'uses' => 'BrandController@updatebrandfeed',
        'as' => 'updatebrandfeed'

    ]);

    Route::get('/brands/{slug}/verified-retailers/{id}', [

        'uses' => 'BrandController@manageverifications',
        'as' => 'manageverifications'

    ]);

    Route::get('/brands/product/request/approve/{id}', [

        'uses' => 'BrandController@approveproductrequest',
        'as' => 'approveproductrequest'

    ]);

    Route::get('/brands/product/request/reject/{id}', [

        'uses' => 'BrandController@rejectproductrequest',
        'as' => 'rejectproductrequest'

    ]);

    // Ajax Call
    Route::post('/getrequestedproductslist', [

        'uses' => 'BrandController@getrequestedproductslist',
        'as' => 'getrequestedproductslist'

    ]);

    Route::get('/brand/{slug}/{id}/product/create', [

        'uses' => 'BrandController@addbrandproduct',
        'as' => 'addbrandproduct'

    ]);

    Route::post('/gettypesubcat', [

        'uses' => 'BrandController@gettypesubcat',
        'as' => 'gettypesubcat'

    ]);

    Route::post('/getparentchildsc', [

        'uses' => 'BrandController@getparentchildsc',
        'as' => 'getparentchildsc'

    ]);

    Route::post('/brand/product/save', [

        'uses' => 'BrandController@savebrandproduct',
        'as' => 'savebrandproduct'

    ]);

    Route::get('/brand/{slug}/product/edit/{brand_id}/{product_id}', [

        'uses' => 'BrandController@editbrandproduct',
        'as' => 'editbrandproduct'

    ]);

    Route::get('/brand/gallery/remove/{id}', [

        'uses' => 'BrandController@removegalleryimage',
        'as' => 'removegalleryimage'

    ]);

    Route::post('/brand/product/update', [

        'uses' => 'BrandController@updatebrandproduct',
        'as' => 'updatebrandproduct'

    ]);

    Route::get('/brands', [

        'uses' => 'WebsiteController@brands',
        'as' => 'brands'

    ]);

    Route::get('/brand/{slug}/{id}', [

        'uses' => 'WebsiteController@brandsingle',
        'as' => 'brandsingle'

    ]);

    Route::get('/brand/product/{slug}/{id}', [

        'uses' => 'WebsiteController@brandproductsingle',
        'as' => 'brandproductsingle'

    ]);

    Route::get('/terms-of-use', [

        'uses' => 'WebsiteController@termsofuse',
        'as' => 'termsofuse'

    ]);

    Route::get('/privacy-policy', [

        'uses' => 'WebsiteController@privacypolicy',
        'as' => 'privacypolicy'

    ]);

    Route::get('/cookie-policy', [

        'uses' => 'WebsiteController@cookiepolicy',
        'as' => 'cookiepolicy'

    ]);

    Route::get('/referal-program', [

        'uses' => 'WebsiteController@referalprogram',
        'as' => 'referalprogram'

    ]);

    Route::get('/business', [

        'uses' => 'WebsiteController@business',
        'as' => 'business'

    ]);

    Route::get('/business/pages', [

        'uses' => 'WebsiteController@businesspages',
        'as' => 'businesspages'

    ]);

    Route::get('/business/ads', [

        'uses' => 'WebsiteController@businessads',
        'as' => 'businessads'

    ]);

    Route::get('/business/deals', [

        'uses' => 'WebsiteController@businessdeals',
        'as' => 'businessdeals'

    ]);

    Route::get('/business/orders', [

        'uses' => 'WebsiteController@businessorders',
        'as' => 'businessorders'

    ]);

    Route::get('/business/stores', [

        'uses' => 'WebsiteController@stores',
        'as' => 'stores'

    ]);

    Route::get('/business/stores/create', [

        'uses' => 'WebsiteController@addnewstore',
        'as' => 'addnewstore'

    ]);

    Route::post('/business/stores/save', [

        'uses' => 'WebsiteController@savenewstore',
        'as' => 'savenewstore'

    ]);

    Route::get('/deal/{id}', [

        'uses' => 'DealsController@dealsingle',
        'as' => 'dealsingle'

    ]);

    Route::post('/claimdeal', [

        'uses' => 'DealsController@claimdeal',
        'as' => 'claimdeal'

    ]);

    Route::get('/deletedealsClaimed/{id}', [
        'uses' => 'DealsController@deleteDealsClaimed',
        'as' => 'deletedealsClaimed'
    ]);

    Route::post('/dealpurchased', [
        'uses' => 'DealsController@dealPurchased',
        'as' => 'dealPurchased'
    ]);

    Route::get('/deal-purchased-list', [
        'uses' => 'DealsController@dealPurchasedList',
        'as' => 'dealPurchasedList'
    ]);

    Route::get('/business-1', [
        'uses' => 'BusinessPagesController@business1',
        'as' => 'business1'
    ]);

    Route::get('/business-2', [
        'uses' => 'BusinessPagesController@business2',
        'as' => 'business2'
    ]);

    Route::get('/business-3', [
        'uses' => 'BusinessPagesController@business3',
        'as' => 'business3'
    ]);

    Route::get('/business-4', [
        'uses' => 'BusinessPagesController@business4',
        'as' => 'business4'
    ]);

    Route::get('/business-5', [
        'uses' => 'BusinessPagesController@business5',
        'as' => 'business5'
    ]);

    Route::get('/products', [
        'uses' => 'ProductsController@index',
        'as' => 'products.index'
    ]);

    Route::get('/products/{category}', [
        'uses' => 'ProductsController@productsCategory',
        'as' => 'products.category'
    ]);

    Route::post('/submit-review', [
        'uses' => 'Api\MenuReviewController@submitReview',
        'as' => 'submit.review'
    ]);

    Route::post('/submit-product-review', [
        'uses' => 'Api\MenuReviewController@submitProductReview',
        'as' => 'submit.product.review'
    ]);

});

