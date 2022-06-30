@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    @if (strlen(trim($deliveryBanner->content)) > 0)
        <section class="bg-dark text-white delivery-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <i class="fas fa-shopping-cart"></i> {{ $deliveryBanner->content }}
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section>
        <div class="container">

            <div class="row topDeliveryRow">
                <div class="col-md-2 text-center col-4 mb-4">
                    @if($delivery->profile_picture == '')
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" class="w-100 h-100 img-thumbnail">
                    @else
                        <img src="{{ $delivery->profile_picture }}" alt="" class="w-100 h-100 img-thumbnail">
                    @endif
                </div>
                <div class="col-md-9 col-8">
                    <h3 class="retailerbnametext text-black-50"><strong>{{ $delivery->business_name }}</strong></h3>
                    <?php
                        $reviews = App\Models\RetailerReview::where('retailer_id', $delivery->id)->whereNull('product_id')->get();
                    ?>
                    <ul class="list-unstyled d-flex ratings">
                        <?php

                            if (count($reviews) > 0) {

                                $sum = 0;
                                foreach ($reviews as $review) {

                                    $sum = $sum + $review->rating;

                                }
                                $totalratings = $sum / $reviews->count();

                            } else {
                                $totalratings = 0;
                            }

                            if ($totalratings < 1) {
                                echo '
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                ';
                            } elseif ($totalratings <= 1) {
                                echo '
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                ';
                            } elseif ($totalratings > 1 AND $totalratings <=2) {
                                echo '
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                ';
                            } elseif ($totalratings > 2 AND $totalratings <=3) {
                                echo '
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                ';
                            } elseif ($totalratings > 3 AND $totalratings <=4) {
                                echo '
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                ';
                            } elseif ($totalratings > 4 AND $totalratings <=5) {
                                echo '
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                ';
                            }

                            echo " <span class='reviewCount'>(".($reviews->count() + str_replace(',', '', $delivery->reviews_count )).")</span>";

                        ?>
                    </ul>
                    <p class="retailerbnametext">{{ $delivery->city }}, {{ $delivery->state_province }}</p>
                </div>
            </div>
            <div class="row detailedBox">
                <div class="col-md-3 col-6">
                    <ul class="list-unstyled">
                        <li class="pb-2"><i class="fas fa-car"></i> Delivery only</li>
                        <li class="pb-2"><i class="fas fa-id-card"></i> {{ $delivery->business_type }}</li>
                        <li class="pb-2"><i class="fas fa-shopping-cart"></i> Order online (delivery)</li>
                    </ul>
                </div>
                <div class="col-md-3 col-6">
                    <ul class="list-unstyled">
                        <li class="pb-2"><i class="fas fa-clock"></i>
                            <?php
                                if ($delivery->opening_time >= date('h:i') OR $delivery->closing_time <= date('h:i')) {
                                    echo "<span style='color: #00b700;font-weight: bold'>OPEN </span>";
                                } else {
                                    echo "<span style='color: rgb(227, 69, 42);font-weight: bold'>CLOSED </span> Opens " . $delivery->opening_time;
                                }
                            ?>
                        </li>
                        {{-- <li class="pb-2">
                            <i class="fas fa-check-circle"></i> License Information
                        </li> --}}
                        <li class="pb-2"><a href="{{ $delivery->instagram }}" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex">
                    <a href="tel:{{ $delivery->phone_number }}" class="btn btn-outline-dark me-2 px-4 ctaButtons ctaButtonFirst">
                        <i class="fas fa-phone-alt"></i> {{ $delivery->phone_number }}
                    </a>
                    <a href="mailto:{{ $delivery->email }}" class="btn btn-outline-dark px-4 ctaButtons ctaButtonSecond" target="_blank">
                        <i class="fas fa-directions"></i> Email the retailer
                    </a>
                    <div class="favBrand favoriteButton">
                        @if (Session::has('customer_id') == false)
                            <a href="{{ route('signin') }}"><i class="far fa-heart pe-4 shadow ms-3"></i></a>
                        @else
                            <a rel="{{ $delivery->id }}" class="favdelivery cursor-pointer"><i class="far fa-heart pe-4 shadow ms-3"></i></a>
                        @endif
                        <span class="followers"> 309 followers</span>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="vue-menu-tab" data-bs-toggle="tab" data-bs-target="#vue-menu" type="button" role="tab" aria-controls="menu" aria-selected="true">Menu</button>
                        </li>

                        {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="menu-tab" data-bs-toggle="tab" data-bs-target="#menu" type="button" role="tab" aria-controls="menu" aria-selected="true">Menu</button>
                        </li> --}}
                        {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Details</button>
                        </li> --}}

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab-new" data-bs-toggle="tab" data-bs-target="#details-new" type="button" role="tab" aria-controls="details" aria-selected="false">Details</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="deals-tab" data-bs-toggle="tab" data-bs-target="#deals" type="button" role="tab" aria-controls="deals" aria-selected="false">Deals</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">

                        {{-- VUE MENU --}}
                        <div class="tab-pane fade show active" id="vue-menu" role="tabpanel" aria-labelledby="vue-menu-tab">
                            <?php
                                $products = \App\Models\DeliveryProducts::where('delivery_id', $delivery->id)->get();

                                $isLogin = false;
                                if(Session::has('customer_id')) {
                                    $isLogin = true;
                                }
                            ?>

                            @if (count($products) > 0)

                            <menu-component id="{{ $delivery->id }}" islogin="<?php echo $isLogin; ?>"></menu-component>
                            @else
                            <div class="container">
                                <div class="refer-card-wrap row">
                                    <div class="refer-card col-sm-6 mx-auto">
                                    <p>THIS RETAILER HASN'T POSTED THEIR MENU ON 420 FINDER YET.</p>
                                    <p>REFER THE BUSINESS AND EARN YOURSELF AN AMAZON GIFT CARD!</p>
                                    <a href="#" class="btn btn-primary" style="background: #F8971C; !important; border-color: #F8971C;">Refer</a>
                                    <p>OR</p>
                                    <p>
                                        CLAIM THIS BUSINESS IF IT IS YOURS BY CLICKING HERE
                                    </p>
                                    <a href="#" class="btn btn-primary" style="background: #F8971C; !important; border-color: #F8971C;">CLAIM</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab">

                            <div class="row mt-2">
                                <div class="col-md-12 showOnMobileRetailerSidebar">
                                    <div class="dropdown">
                                      <button class="btn border br-30 bg-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Category
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        @if($categories->count() > 0)
                                            @foreach($categories as $category)
                                            <li class="dropdown-item">
                                                <a href="{{ route('deliverysinglecategory', ['name' => $delivery->business_name, 'id' => $delivery->id, 'category' => $category->id]) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                            @endforeach
                                        @else
                                            <li>No Categories</li>
                                        @endif
                                      </ul>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4 hideRetailerDetailSidebar">
                                    <div class="card p-3 pb-0">
                                        <p class="vrmobile">Verified Retailer <i class="fas fa-check-circle" style="color: #66CCFF;"></i></p>
                                    </div>
                                    <div class="p-3 pb-0">
                                        <div class="row border-bottom">
                                            <div class="col-md-12">
                                                <h5 class="mb-4 sidebarHeadingRetailer"><strong>Categories</strong></h5>
                                                <ul class="list-unstyled list-group-numbered">
                                                    @if($categories->count() > 0)
                                                        @foreach($categories as $category)
                                                        <li class="sidebarRetailerBoxes"><a href="{{ route('deliverysinglecategory', ['name' => $delivery->business_name, 'id' => $delivery->id, 'category' => $category->id]) }}">{{ $category->name }}</a></li>
                                                        @endforeach
                                                    @else
                                                        <li>No Categories</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3 pb-0">
                                        <div class="row border-bottom">
                                            <div class="col-md-12">
                                                <h5 class="mb-4 sidebarHeadingRetailer"><strong>Sub Categories</strong></h5>
                                                <ul class="list-unstyled list-group-numbered">
                                                    @if($subcategories->count() > 0)
                                                        @foreach($subcategories as $cat)
                                                        <li class="sidebarRetailerBoxes"><a href="{{ route('deliverysinglesubcategory', ['name' => $delivery->business_name, 'id' => $delivery->id, 'subcategory' => $cat->id]) }}">{{ $cat->name }}</a></li>
                                                        @endforeach
                                                    @else
                                                        <li>No Sub Categories</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3 pb-0">
                                        <div class="row sidebarBrands border-bottom">
                                            <div class="col-md-12">
                                                <h5 class="mb-4 sidebarHeadingRetailer"><strong>Brands</strong></h5>
                                                <ul class="list-unstyled">
                                                    @if($brands->count() > 0)
                                                        @foreach($brands as $brand)
                                                        <li class="pb-3 pt-3 border-bottom sidebarRetailerBoxes">
                                                            <img src="{{ $brand->logo }}" style="width: 50px;height: 50px;" class="img-thumbnail retailerBrandImage">
                                                            <span>{{ $brand->name }}</span>
                                                        </li>
                                                        @endforeach
                                                    @else
                                                        <li>No Sub Categories</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8 col-8">
                                    <div class="row">
                                        <div class="col-6 py-4" style="font-size: 0.75rem;">
                                            <span>{{ $featured->count() }}</span> results found
                                            <h5 class="pt-2"><strong>Featured products</strong></h5>
                                        </div>
                                        <div class="col-6 py-4 text-end">
                                            <span class="liveMenu">Live Menu</span>
                                        </div>
                                        @if($featured->count() > 0)
                                            @foreach($featured as $product)

                                                <div class="col-md-3 col-6 mb-3 cursor-pointer" onclick="location.href='{{ route("retailerproduct", ["business_type" => $delivery->business_type, "slug" => $product->slug, "product_id" => $product->id]) }}';">

                                                    <div class="card">
                                                        @if($product->off > 0)
                                                            <label class="label-off">{{ $product->off }}% off</label>
                                                        @endif
                                                        <div>
                                                            <img src="{{ $product->image }}" class="card-img-top" alt="...">
                                                        </div>
                                                        <div class="p-3">
                                                            <p class="text-black-50 height-50 subcatnames">{{ str_replace(", "," | ", $product->subcategory_names) }}</p>
                                                            <p>featured: {{ $product->is_featured }}</p>
                                                            <h6 class="pnamemobile"><strong>{{ substr($product->name, 0, 20) }}...</strong></h6>

                                                            <?php
                                                                $reviews = App\Models\RetailerReview::where('product_id', $product->id)->get();
                                                            ?>

                                                            <ul class="list-unstyled d-flex ratings">
                                                                <?php

                                                                    if (count($reviews) > 0) {

                                                                        $sum = 0;
                                                                        foreach ($reviews as $review) {

                                                                            $sum = $sum + $review->rating;

                                                                        }
                                                                        $totalratings = $sum / $reviews->count();

                                                                    } else {
                                                                        $totalratings = 0;
                                                                    }

                                                                    if ($totalratings < 1) {
                                                                        echo '
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        ';
                                                                    } elseif ($totalratings <= 1) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        ';
                                                                    } elseif ($totalratings > 1 AND $totalratings <=2) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        ';
                                                                    } elseif ($totalratings > 2 AND $totalratings <=3) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        ';
                                                                    } elseif ($totalratings > 3 AND $totalratings <=4) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        ';
                                                                    } elseif ($totalratings > 4 AND $totalratings <=5) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                        ';
                                                                    }

                                                                    echo " <span class='reviewCount'>(".$reviews->count().")</span>";

                                                                ?>
                                                            </ul>
                                                            <?php
                                                                if($product->off == 0) {
                                                                    ?>
                                                                    <span class="current_price">${{ $product->price }}</span>
                                                                    <?php
                                                                } else {

                                                                    $new_amount = ($product->off / 100) * $product->price;
                                                                    $returningAmount = $product->price - $new_amount;
                                                                    $offprice = number_format((float)$returningAmount, 2, '.', '');
                                                                    ?>
                                                                    <span class="current_price">${{ $offprice }}</span>
                                                                    <span class="old_price">${{ $product->price }}</span>
                                                                    <?php
                                                                }
                                                            ?>
                                                            <div class="text-center mt-4">
                                                                @if (Session::has('customer_id') == false)
                                                                    <a class="btn appointment-btn ms-0 w-100" href="{{ route('signin') }}">Add to cart</a>
                                                                @else
                                                                    <button rel="{{ $product->id }}" class="btn appointment-btn ms-0 w-100 addtocartdelivery">Add to cart</button>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            @endforeach
                                        @else
                                        <div class="col-md-12 text-center">
                                            <h4>No Products Found!</h4>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        @if($products->count() > 0)
                                            @foreach($products as $product)

                                                <div class="col-md-12 col-12 mb-3 cursor-pointer" onclick="location.href='{{ route("retailerproduct", ["business_type" => $delivery->business_type, "slug" => $product->slug, "product_id" => $product->id]) }}';">

                                                    <div class="row border py-2 mt-4">
                                                        <div class="col-12 col-md-2">
                                                            <img src="{{ $product->image }}" class="card-img-top" alt="...">
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            <p class="text-black-50 subcatnames" style="font-size: 12px;margin-bottom: 5px;">{{ str_replace(", "," | ", $product->subcategory_names) }}</p>
                                                            <h6 class="pnamemobile"><strong>{{ substr($product->name, 0, 20) }}...</strong></h6>

                                                            <?php
                                                                $reviews = App\Models\RetailerReview::where('product_id', $product->id)->get();
                                                            ?>

                                                            <ul class="list-unstyled d-flex ratings">
                                                                <?php

                                                                    if (count($reviews) > 0) {

                                                                        $sum = 0;
                                                                        foreach ($reviews as $review) {

                                                                            $sum = $sum + $review->rating;

                                                                        }
                                                                        $totalratings = $sum / $reviews->count();

                                                                    } else {
                                                                        $totalratings = 0;
                                                                    }

                                                                    if ($totalratings < 1) {
                                                                        echo '
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        ';
                                                                    } elseif ($totalratings <= 1) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        ';
                                                                    } elseif ($totalratings > 1 AND $totalratings <=2) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        ';
                                                                    } elseif ($totalratings > 2 AND $totalratings <=3) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        ';
                                                                    } elseif ($totalratings > 3 AND $totalratings <=4) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        ';
                                                                    } elseif ($totalratings > 4 AND $totalratings <=5) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                        ';
                                                                    }

                                                                    echo " <span class='reviewCount'>(".$reviews->count().")</span>";

                                                                ?>
                                                            </ul>

                                                        </div>
                                                        <div class="col-12 col-md-2">
                                                            <?php
                                                                if($product->off == 0) {
                                                                    ?>
                                                                    <span class="current_price">${{ $product->price }}</span>
                                                                    <?php
                                                                } else {

                                                                    $new_amount = ($product->off / 100) * $product->price;
                                                                    $returningAmount = $product->price - $new_amount;
                                                                    $offprice = number_format((float)$returningAmount, 2, '.', '');
                                                                    ?>
                                                                    <span class="current_price">${{ $offprice }}</span>
                                                                    <span class="old_price">${{ $product->price }}</span>
                                                                    <?php
                                                                }
                                                            ?>
                                                            <div class="text-center mt-4">
                                                                @if (Session::has('customer_id') == false)
                                                                    <a class="btn appointment-btn ms-0 w-100" href="{{ route('signin') }}">Add to cart</a>
                                                                @else
                                                                    <button rel="{{ $product->id }}" class="btn appointment-btn ms-0 w-100 addtocartdelivery">Add to cart</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        @else
                                        <div class="col-md-12 text-center">
                                            <h4>No Products Found!</h4>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div> --}}
                        {{-- <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h4 class="pb-4"><strong>Delivery Name: </strong> {{ $delivery->business_name }}</h4>
                                    <p><strong>Postal Code: </strong> {{ $delivery->postal_code }}</p>
                                    <p><strong>City: </strong> {{ $delivery->city }}</p>
                                    <p><strong>State/Province: </strong> {{ $delivery->state_province }}</p>
                                    <p><strong>Country: </strong> {{ $delivery->country }}</p>
                                    <p><strong>License No. </strong> {{ $delivery->license_number }}</p>
                                    <p><strong>License Type: </strong> {{ $delivery->license_type }}</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="border">
                                        <iframe src="https://maps.google.com/maps?q=35.856737, 10.606619&z=15&output=embed" width="100%" height="300" frameborder="0" style="border:0"></iframe>
                                        <div class="row p-3">
                                            <div class="col-md-12 pb-3">
                                                <i class="fas fa-map-marker-alt"></i> &nbsp;&nbsp; {{ $delivery->address_line_1 }}
                                            </div>
                                            <div class="col-md-12 pb-3">
                                                <i class="fas fa-phone-alt"></i> &nbsp;&nbsp; {{ $delivery->phone_number }}
                                            </div>
                                            <div class="col-md-12 pb-3">
                                                <i class="fas fa-envelope"></i> &nbsp;&nbsp; {{ $delivery->email }}
                                            </div>
                                            <div class="col-md-12 pb-3">
                                                <i class="fas fa-globe"></i> &nbsp;&nbsp; <a href="{{ $delivery->website }}">{{ $delivery->website }}</a>
                                            </div>
                                            <div class="col-md-12 pb-3 pt-3">
                                                <h6 class="text-danger">
                                                    <strong>
                                                        <?php
                                                            if ($delivery->opening_time >= date('h:i') OR $delivery->closing_time <= date('h:i')) {
                                                                echo "Open now!";
                                                            } else {
                                                                echo "Closed. Opens at " . $delivery->opening_time;
                                                            }
                                                        ?>
                                                    </strong>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="tab-pane fade" id="details-new" role="tabpanel" aria-labelledby="details-tab">
                            <div class="row mt-5 detail-row">
                                <div class="col-md-7">


                                  @if(!is_null($detail))
                                    <div class="left-content">
                                        {{-- Introduction --}}
                                        <div class="detail-introduction">
                                            <h3 class="left-content-head">Introduction</h3>

                                        <div class="detail-intro-content">
                                            {!! $detail->introduction !!}
                                            </div>
                                        </div>

                                        {{-- About Us --}}
                                        <div class="detail-about">
                                            <h3 class="left-content-head">About Us</h3>
                                            <div class="detail-about-content">
                                             {!! $detail->about !!}
                                            </div>
                                        </div>

                                        {{-- Amenities --}}
                                        {{-- <div class="detail-amenities">
                                            <h3 class="left-content-head">Amenities</h3>
                                            <div class="detail-ameni-content">

                                                <?php
                                                    // $amenities = json_decode($detail->amenities, true);
                                                ?>

                                                @foreach ($amenities as $key => $ameni)

                                                @if ($key == 'brand_verified' && $ameni == 'on')
                                                <div class="detail-ameni-item">
                                                    <svg class="finder-icon-brand" width="24" height="24" viewBox="0 0 24 24"><path class="finder-icon-brand" fill-rule="evenodd" clip-rule="evenodd" d="m9.32 22 2.68-.66 2.68.66 1.99-1.912 2.65-.768.768-2.65L22 14.68 21.34 12 22 9.32l-1.912-1.99-.768-2.65-2.65-.768L14.68 2 12 2.661 9.32 2 7.33 3.912l-2.65.767-.768 2.651L2 9.32 2.661 12 2 14.68l1.912 1.99.767 2.65 2.651.768L9.32 22Zm1.16-5.55.002.002 7.327-7.193-1.743-1.71-5.585 5.482-2.547-2.5-1.743 1.711 4.288 4.21.001-.002Z" fill="#7C7C7C"></path></svg>

                                                    <span>Brand Verified</span>

                                                </div>
                                                @elseif ($key == 'access' && $ameni == 'on')
                                                <div class="detail-ameni-item">
                                                    <svg class="finder-icon-accessible" width="24px" height="24px" viewBox="-2 0 20 20"><path fill="#7C7C7C" d="M7.73 18.734c-.15 0-.3-.005-.45-.014-3.74-.24-6.583-3.4-6.338-7.042.08-1.16.472-2.284 1.14-3.25.284-.412 1.82.595 1.534 1.008-.484.7-.77 1.517-.827 2.36-.18 2.65 1.89 4.95 4.612 5.125 1.982.128 3.848-.91 4.743-2.648.23-.445 1.883.364 1.654.81-1.162 2.253-3.51 3.652-6.07 3.652zm-.455-3.8c-.302 0-.598-.143-.776-.408L4.813 12.01c-.12-.18-.17-.393-.142-.603l.37-2.975c.064-.494.525-.845 1.033-.784.507.06.867.51.804 1.005L6.55 11.3l1.5 2.24c.28.417.158.976-.27 1.248-.156.1-.33.146-.505.146zM6.322 6.96c-.068 0-.136-.003-.205-.007C5.295 6.9 4.544 6.54 4 5.935c-.543-.603-.813-1.376-.758-2.177.11-1.64 1.585-2.897 3.28-2.8.822.05 1.573.412 2.117 1.016.542.603.812 1.377.757 2.178C9.29 5.726 7.94 6.96 6.322 6.96zm10.475 8.885c-.02 0-.04 0-.06-.002l-1.233-.08c-.42-.026-.768-.325-.848-.728l-.493-2.49c-.025-.128-.11-.2-.157-.23-.047-.032-.148-.08-.278-.056l-3.983.767c-.495.098-.988-.22-1.087-.71-.1-.488.227-.962.728-1.06l3.983-.767c.583-.11 1.177.004 1.67.328.493.323.828.816.94 1.385l.358 1.808.518.033c.51.033.897.462.864.96-.033.476-.44.842-.923.842z"></path></svg>
                                                    <span>Accessible</span>

                                                </div>
                                                @elseif ($key == 'security' && $ameni == 'on')
                                                <div class="detail-ameni-item">
                                                    <svg class="finder-icon-solid-lock" height="24px" width="24px" viewBox="0 0 24 24"><path fill="#7C7C7C" d="M10.268 18.408c.196.19.45.294.715.294.265 0 .519-.105.715-.294l3.612-3.496c.469-.454.469-1.25 0-1.704a1.025 1.025 0 0 0-.715-.294c-.265 0-.52.105-.715.294l-2.672 2.587a.306.306 0 0 1-.45 0l-.702-.68a1.025 1.025 0 0 0-.715-.293c-.266 0-.52.104-.715.293l-.092.09v.012a1.21 1.21 0 0 0 .092 1.602l1.642 1.59zM5.7 19.551h12.6v-7.423H5.7v7.423zM8.246 9.48V7.803c0-1.9 1.633-3.446 3.64-3.446 2.006 0 3.639 1.546 3.639 3.446v1.68c0 .132.024.259.067.378H8.18c.042-.119.066-.246.066-.378zm11.384.379h-1.683c.042-.119.066-.246.066-.378v-1.68c0-3.2-2.749-5.802-6.127-5.802-3.379 0-6.128 2.603-6.128 5.802v1.68c0 .132.024.259.067.378H4.307C3.585 9.86 3 10.414 3 11.097v9.495c0 .683.585 1.237 1.307 1.237H19.63c.72 0 1.306-.554 1.306-1.237v-9.495c0-.683-.585-1.237-1.306-1.237z"></path></svg>
                                                    <span>Security</span>

                                                </div>
                                                @endif

                                                @endforeach

                                            </div>
                                        </div> --}}

                                        {{-- Customers --}}
                                        <div class="detail-customer">
                                            <h3 class="left-content-head">First-Time Customers</h3>
                                            <div class="detail-customer-content">
                                                {!! $detail->customers !!}
                                            </div>
                                        </div>

                                        {{-- Announcement --}}
                                        <div class="detail-announcement">
                                            <h3 class="left-content-head">Announcement</h3>
                                            <div class="detail-announ-detail">
                                                {!! $detail->announcement !!}
                                                <div class="state-license">
                                                    <h5>State License</h5>
                                                    {!! $detail->license !!}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                  @else
                                    <p>Detail Not Added Yet.</p>
                                  @endif
                                </div>

                                <div class="col-md-5">
                                    <div class="right-content-wrap">

                                         <details-map latitude="{{ $delivery->latitude }}" longitude="{{ $delivery->longitude }}" deliveryid="{{ $delivery->id }}"></details-map>

                                          {{-- RIGHT CONTENT EXTRA --}}
                                          <div class="right-content-extra">

                                            {{-- DELIVERY PLACE --}}
                                            <div class="location-name">
                                                <div class="location-icon">
                                                    <svg class="finder-icon-map-pin" width="22px" height="22px" stroke="none" viewBox="0 0 24 24"><path d="M4 9.5c0 1.563.533 3 1.4 4.25L12 22l6.6-8.25A7.271 7.271 0 0 0 20 9.5C20 5.375 16.4 2 12 2S4 5.375 4 9.5zm4 .5c0-2.2 1.8-4 4-4s4 1.8 4 4-1.8 4-4 4-4-1.8-4-4z" overflow="visible" fill="#999999"></path></svg>
                                                </div>

                                                <p>{{ $delivery->address_line_1 }} {{ $delivery->city }}, {{ $delivery->state_province }}</p>

                                            </div>

                                            {{-- DELIVERY PHONE --}}
                                            <div class="delivery-phone">
                                                <div class="phone-icon">
                                                    <svg class="finder-icon-phone" width="20px" height="20px" viewBox="0 0 24 24"><path fill="#999999" d="M6.65 10.02c.12.28 2.07 4.94 7.43 7.23l1.7-1.72c.3-.3.75-.4 1.14-.26 1.25.4 2.6.63 3.97.63.61 0 1.11.5 1.11 1.11v3.88c0 .61-.5 1.11-1.11 1.11A18.89 18.89 0 012 3.11C2 2.5 2.5 2 3.11 2H7c.61 0 1.11.5 1.11 1.11 0 1.39.22 2.72.63 3.97.13.39.04.82-.27 1.13l-1.82 1.81z"></path></svg>
                                                </div>
                                                <a href="tel:{{ $delivery->phone_number }}">{{ $delivery->phone_number }}</a>
                                            </div>

                                            {{-- DELIVERY TIME --}}
                                            <div class="delivery-time delivery-common">
                                                <div class="time-icon">
                                                    <svg class="" height="20px" width="20px" viewBox="0 0 24 24"><path fill="#999999" d="M11.805 14.019H7.94a1.21 1.21 0 1 1 0-2.418h2.657V7.25a1.21 1.21 0 0 1 2.419 0v5.559a1.21 1.21 0 0 1-1.21 1.209M12 4.04C7.611 4.04 4.04 7.61 4.04 12c0 4.389 3.571 7.96 7.96 7.96 4.389 0 7.96-3.571 7.96-7.96 0-4.389-3.571-7.96-7.96-7.96M12 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10"></path></svg>
                                                </div>
                                                <div class="time-content">
                                                    <h6>
                                                    <?php
                                                        if ($delivery->opening_time >= date('h:i') OR $delivery->closing_time <= date('h:i')) {
                                                            echo 'OPEN';
                                                        } else {
                                                            echo 'CLOSED';
                                                        }
                                                    ?> NOW</h6>
                                                    <div class="week-content-wrap">
                                                        <div class="week-content">
                                                            {{-- MONDAY --}}
                                                            <div class="week-day">
                                                                <span>Monday</span>
                                                            </div>
                                                            <div class="week-time">
                                                                <span>{{ $delivery->opening_time }}AM - {{ $delivery->closing_time }}PM</span>
                                                            </div>
                                                        </div>
                                                     <div class="week-content">
                                                            {{-- TUESDAY --}}
                                                            <div class="week-day">
                                                                <span>Tuesday</span>
                                                            </div>
                                                            <div class="week-time">
                                                                <span>{{ $delivery->opening_time }}AM - {{ $delivery->closing_time }}PM</span>
                                                            </div>
                                                        </div>
                                                        <div class="week-content">
                                                              {{-- WEDNESDAY --}}
                                                            <div class="week-day">
                                                                <span>Wednesday</span>
                                                            </div>
                                                            <div class="week-time">
                                                                <span>{{ $delivery->opening_time }}AM - {{ $delivery->closing_time }}PM</span>
                                                            </div>

                                                        </div>

                                                        <div class="week-content">
                                                               {{-- THURSDAY --}}
                                                               <div class="week-day">
                                                                <span>Thursday</span>
                                                            </div>
                                                            <div class="week-time">
                                                                <span>{{ $delivery->opening_time }}AM - {{ $delivery->closing_time }}PM</span>
                                                            </div>
                                                        </div>

                                                        <div class="week-content">
                                                            {{-- FRIDAY --}}
                                                            <div class="week-day">
                                                             <span>Friday</span>
                                                         </div>
                                                         <div class="week-time">
                                                            <span>{{ $delivery->opening_time }}AM - {{ $delivery->closing_time }}PM</span>
                                                         </div>
                                                     </div>

                                                     <div class="week-content">
                                                    {{-- SATURDAY --}}
                                                        <div class="week-day">
                                                         <span>Saturday</span>
                                                     </div>
                                                     <div class="week-time">
                                                        <span>{{ $delivery->opening_time }}AM - {{ $delivery->closing_time }}PM</span>
                                                     </div>
                                                     </div>

                                                      <div class="week-content">
                                                        {{-- SUNDAY --}}
                                                            <div class="week-day">
                                                             <span>Sunday</span>
                                                         </div>
                                                         <div class="week-time">
                                                            <span>{{ $delivery->opening_time }}AM - {{ $delivery->closing_time }}PM</span>
                                                         </div>
                                                      </div>


                                                    </div>

                                                </div>
                                            </div>

                                            {{-- DELIVERY EMAIL --}}
                                              @if($delivery->email != null)
                                            <div class="delivery-email delivery-common">
                                                <div class="email-icon">
                                                    <svg class="finder-icon-envelope" width="20px" height="20px" viewBox="0 0 24 24"><path fill="#999999" fill-rule="evenodd" d="M4 5h16c1.1 0 2 .79 2 1.75v.88l-10 5.74L2 7.63l.01-.88C2.01 5.79 2.9 5 4 5zM2 9.93v-2.3 2.3zm20 0l-10 5.73L2 9.93v7.32c0 .96.9 1.75 2 1.75h16c1.1 0 2-.79 2-1.75V9.92z" clip-rule="evenodd"></path></svg>
                                                </div>

                                                <a href="mailto:{{ $delivery->email }}">{{ $delivery->email }}</a>

                                            </div>
                                              @endif

                                            {{-- DELIVERY LINK --}}
                                            <div class="delivery-link delivery-common">
                                                <div class="link-icon">
                                                    <svg class="finder-icon-link" height="20px" width="20px" viewBox="0 0 24 24"><path fill="#999999" d="M9.536 13.15h4.902a1.225 1.225 0 1 0 0-2.452H9.536a1.225 1.225 0 1 0 0 2.451M15.827 6h-1.026a1.2 1.2 0 0 0 0 2.4h1.085c2.003 0 3.71 1.587 3.714 3.59.005 2.045-1.556 3.61-3.6 3.61h-1.2a1.2 1.2 0 1 0 0 2.4H16c3.364 0 6.006-2.646 6-6.012C21.994 8.651 19.164 6 15.827 6M4.4 11.99C4.405 9.988 6.11 8.4 8.114 8.4h1.085a1.2 1.2 0 1 0 0-2.4H8.173C4.836 6 2.006 8.65 2 11.988 1.994 15.354 4.636 18 8 18h1.2a1.2 1.2 0 1 0 0-2.4H8c-2.044 0-3.605-1.565-3.6-3.61"></path></svg>
                                                </div>
                                                <a href="{{ $delivery->website }}" target="_blank">
                                                    {{ $delivery->website }}
                                                </a>
                                            </div>

                                            {{-- DELIVERY SOCIAL - INSTAGRAM --}}
                                            <div class="delivery-insta delivery-common">
                                                <div class="insta-icon">
                                                    <svg class="finder-icon wm-instagram-standard" width="20px" height="20px" viewBox="0 0 24 24"><path fill="#999999" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"></path></svg>
                                                </div>
                                               <a href="{{ $delivery->instagram??"#" }}">
                                                   @Instagram
                                               </a>
                                            </div>

                                            {{-- DELIVERY SOCIAL - TWITTER --}}
                                            <div class="delivery-twitter delivery-common">
                                                <div class="twitter-icon">
                                                    <svg class="wm-icon-twitter-standard" width="20px" height="20px" viewBox="0 0 21 21"><g transform="translate(-1 -2)"><path fill="#999999" d="M22 6.8l-2.4.6c1-.5 1.5-1.2 1.8-2.1-.8.4-1.6.7-2.6.9a4.1 4.1 0 0 0-3-1.2c-1 0-2 .4-2.9 1.1a3.5 3.5 0 0 0-1 3.6 12.2 12.2 0 0 1-8.5-4 3.5 3.5 0 0 0 0 3.7c.3.6.7 1 1.3 1.4-.7 0-1.3-.2-1.9-.5 0 1 .3 1.7 1 2.4.6.7 1.4 1.2 2.3 1.3a4.6 4.6 0 0 1-1.9.1A4.2 4.2 0 0 0 8 16.7a8.5 8.5 0 0 1-6 1.6 12.9 12.9 0 0 0 10.4 1 10.7 10.7 0 0 0 5.6-4.1 10.6 10.6 0 0 0 2-6.5c.7-.5 1.4-1.2 2-2z"></path></g></svg>
                                                </div>
                                                <a href="{{ $delivery->twitter??"#" }}">
                                                    @Twitter
                                                </a>
                                            </div>

                                            {{-- DELIVERY SOCIAL - FACEBOOK --}}
                                            <div class="delivery-facebook delivery-common">
                                                <div class="fb-icon">
                                                    <svg class="finder-icon-facebook-standard" width="20px" height="20px" viewBox="0 0 24 24"><path fill="#999999" fill-rule="nonzero" d="M14.3 8.6V6.8v-.6l.3-.4.4-.3h3V2h-3.3c-1.9 0-3.2.4-4 1.1-.9.8-1.3 2-1.3 3.4v2H7V12h2.4v10h5V12h3.2l.4-3.4h-3.7z"></path></svg>
                                                </div>
                                                <a href="{{ $delivery->facebook??"#" }}">Facebook</a>
                                            </div>


                                            </div>
                                            {{-- RIGHT CONTENT EXTRA ENDS --}}

                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade deals-tab" id="deals" role="tabpanel" aria-labelledby="deals-tab">
                            <div class="row">


                            @forelse ($deals as $deal)

                            <div class="col-4">

                                <div class="post-slide">

                                    <div class="card">
                                        @if($deal->percentage > 0)
                                            <label class="label-off">{{ $deal->percentage }}% off</label>
                                        @endif
                                        <div class="post-img">
                                            <img src="{{ json_decode($deal->picture)[0] }}" class="card-img-top" alt="...">
                                            <a href="{{ route('dealsingle', ['id' => $deal->id]) }}" class="col-md-3 col-6 mb-3 cursor-pointer over-layer"><i class="fa fa-link"></i>
                                            </a>
                                        </div>
                                        <div class="p-3" style="border-top: 3px solid #f8971c;">
                                            <span class="text-black-50">{{ $business->business_name }}</span>
                                            <h6 class="pnamemobile">
                                                <strong>{{ substr($deal->title, 0, 25) }}...</strong>
                                            </h6>
                                            <span class="text-black-50"><i class="fas fa-box"></i> {{ $business->business_type }}</span><br>
                                            <span style="font-size: 18px;">{{ $business->license_type }}</span>
                                        </div>

                                    </div>

                                </div>
                             </div>
                            @empty
                            <div class="row">
                                <div class="col-md-11 col-11 ps-4 mx-auto">
                                    <p class="p-bold">
                                        THIS RETAILER DOES NOT CURRENTLY HAVE ANY ACTIVE DEALS ON 420 FINDER.
                                    </p>
                                    </div>
                                  </div>
                            @endforelse

                            </div>
                        </div>

                        <div class="tab-pane fade review-tab" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                             @if(session()->has('customer_id'))
                               <retailer-reviews retailerid="{{ $delivery->id }}" :user="true" isreviewed="{{ $isReviewed }}"></retailer-reviews>
                             @else
                               <retailer-reviews retailerid="{{ $delivery->id }}" :user="false" isreviewed="{{ $isReviewed }}"></retailer-reviews>
                             @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

