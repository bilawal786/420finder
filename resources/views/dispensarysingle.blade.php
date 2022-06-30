@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <style>
        .liveMenu {
            border: 1px solid green;
            color: green;
            padding: 2px 6px;
            border-radius: 5px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .liveMenu:before {
            content: "•";
            width: 0.375rem;
            height: 0.375rem;
            font-size: 14px;
            border-radius: 50%;
            margin-right: 0.25rem;
        }
        i.fa.fa-star {
            color: #f8971c;
        }
        .showOnMobileRetailerSidebar {
            display: none;
        }
        @media(max-width:  980px) {
            .showOnMobileRetailerSidebar button {
                font-size: 12px;
            }
            .showOnMobileRetailerSidebar {
                display: block;
                margin-top: 15px;
            }
            .hideRetailerDetailSidebar {
                display: none;
            }
            i.fa.fa-star {
                font-size: 24px;
            }
            span.reviewCount {
                font-size: 14px;
            }
            .topDeliveryRow .col-4 img {
                width: 100% !important;
            }
            .topDeliveryRow .col-4 {
                text-align: left !important;
            }
            .topDeliveryRow .col-8 h3 {
                text-align: left;
                font-size: 24px;
            }
            .topDeliveryRow .col-8 p {
                text-align: left;
            }
            .detailedBox {
                padding: 10px 20px;
            }
            .retailerbnametext {
                font-size: 18px;
            }
            span.followers {
                display: none;
            }
            .favBrand.favoriteButton {
                position: absolute;
                top: 29%;
                right: 6%;
            }
            .ctaButtonFirst, .ctaButtonSecond {
                width: 50%;
                border: 1 px solid silver;
            }
        }
    </style>

    <section class="mt-5 bg-dark text-white pt-5">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fas fa-shopping-cart"></i> Select a product to start your order!
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">

            <div class="row topDeliveryRow">
                <div class="col-md-2 text-center col-4 mb-4">
                    @if($dispensary->profile_picture == '')
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" class="w-100 h-100 img-thumbnail">
                    @else
                        <img src="{{ $dispensary->profile_picture }}" alt="" class="w-100 h-100 img-thumbnail">
                    @endif
                </div>

                <div class="col-md-9 col-8">
                    <h3 class="retailerbnametext text-black-50"><strong>{{ $dispensary->business_name }}</strong></h3>
                    <?php
                        $reviews = App\Models\RetailerReview::where('retailer_id', $dispensary->id)->get();
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

                            echo " <span class='reviewCount'>(".($reviews->count() + str_replace(',', '', $dispensary->reviews_count )).")</span>";

                        ?>
                    </ul>
                    <p class="retailerbnametext">{{ $dispensary->city }}, {{ $dispensary->state_province }}</p>

                </div>
            </div>
            <div class="row detailedBox">
                <div class="col-md-3 col-6">
                    <ul class="list-unstyled">
                        <li class="pb-2"><i class="fas fa-store"></i> Store Front</li>
                        <li class="pb-2"><i class="fas fa-id-card"></i> {{ $dispensary->business_type }}</li>
                        <li class="pb-2"><i class="fas fa-shopping-cart"></i> Order online (only pickup)</li>
                    </ul>
                </div>
                <div class="col-md-3 col-6">
                    <ul class="list-unstyled">
                        <li class="pb-2"><i class="fas fa-clock"></i>
                            <?php
                                if ($dispensary->opening_time >= date('h:i') OR $dispensary->closing_time <= date('h:i')) {
                                    echo "Open now!";
                                } else {
                                    echo "Closed. Opens at" . $dispensary->opening_time;
                                }
                            ?>
                        </li>
                        <li class="pb-2">
                            <i class="fas fa-check-circle"></i> License Information
                        </li>
                        <li class="pb-2"><a href="{{ $dispensary->instagram }}" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex">
                    <a href="tel:{{ $dispensary->phone_number }}" class="btn btn-outline-dark me-2 px-4 ctaButtons ctaButtonFirst">
                        <i class="fas fa-phone-alt"></i> {{ $dispensary->phone_number }}
                    </a>
                    <a href="http://maps.google.com/?q={{ $dispensary->latitude }},{{ $dispensary->longitude }}" class="btn btn-outline-dark px-4 ctaButtons ctaButtonSecond" target="_blank">
                        <i class="fas fa-directions"></i> Directions
                    </a>
                    <div class="favBrand favoriteButton">
                        @if (Session::has('customer_id') == false)
                            <a href="{{ route('signin') }}"><i class="far fa-heart pe-4 shadow ms-3"></i></a>
                        @else
                            <a rel="{{ $dispensary->id }}" class="favdispensary cursor-pointer"><i class="far fa-heart pe-4 shadow ms-3"></i></a>
                        @endif
                        <span class="followers"> 309 followers</span>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="menu-tab" data-bs-toggle="tab" data-bs-target="#menu" type="button" role="tab" aria-controls="menu" aria-selected="true">Menu</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                            <div class="row">
                                <div class="col-md-12 px-4 mt-4">
                                    <div class="retailerAlert alert alert-info alert-dismissible fade show" role="alert">
                                      <strong><i class="fas fa-check-circle" style="color: #66CCFF;"></i> BRAND VERIFIED:</strong> This blue icon appears on products sold by retailers authorized by a brand to carry those products.
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 showOnMobileRetailerSidebar">
                                    <div class="dropdown">
                                      <button class="btn border br-30 bg-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Category
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        @if($categories->count() > 0)
                                            @if($categories->count() > 0)
                                                @foreach($categories as $category)
                                                <li class="dropdown-item">
                                                    <a href="{{ route('dispensarysinglecategory', ['name' => $dispensary->business_name, 'id' => $dispensary->id, 'category' => $category->id]) }}">{{ $category->name }}</a>
                                                </li>
                                                @endforeach
                                            @else
                                                <li>No Categories</li>
                                            @endif
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
                                                        <li class="sidebarRetailerBoxes"><a href="{{ route('dispensarysinglecategory', ['name' => $dispensary->business_name, 'id' => $dispensary->id, 'category' => $category->id]) }}">{{ $category->name }}</a></li>
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
                                                        <li class="sidebarRetailerBoxes"><a href="{{ route('dispensarysinglesubcategory', ['name' => $dispensary->business_name, 'id' => $dispensary->id, 'subcategory' => $cat->id]) }}">{{ $cat->name }}</a></li>
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
                                            <div class="col-md-3 col-6 mb-3 cursor-pointer" onclick="location.href='{{ route("retailerproduct", ["business_type" => $dispensary->business_type, "slug" => $product->slug, "product_id" => $product->id]) }}';">

                                                <div class="card">
                                                    @if($product->off > 0)
                                                        <label class="label-off">{{ $product->off }}% off</label>
                                                    @endif
                                                    <div>
                                                        <img src="{{ $product->image }}" class="card-img-top" alt="...">
                                                    </div>
                                                    <div class="p-3">
                                                        <p class="text-black-50 height-50 subcatnames">{{ str_replace(", "," | ", $product->subcategory_names) }}</p>
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
                                                            @if(Session::has('customer_id') == false)
                                                                <a class="btn appointment-btn ms-0 w-100" href="{{ route('signin') }}">Add to cart</a>
                                                            @else
                                                                <button rel="{{ $product->id }}" class="addtocartdispensary btn appointment-btn ms-0 w-100">Add to cart</button>
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
                                            <div class="col-md-12 col-12 mb-3 cursor-pointer" onclick="location.href='{{ route("retailerproduct", ["business_type" => $dispensary->business_type, "slug" => $product->slug, "product_id" => $product->id]) }}';">

                                                <div class="row border py-2 mt-4">
                                                    <div class="col-12 col-md-2">
                                                        <img src="{{ $product->image }}" class="card-img-top" alt="...">
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <p class="text-black-50 height-50 subcatnames">{{ str_replace(", "," | ", $product->subcategory_names) }}</p>
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
                                                            @if(Session::has('customer_id') == false)
                                                                <a class="btn appointment-btn ms-0 w-100" href="{{ route('signin') }}">Add to cart</a>
                                                            @else
                                                                <button rel="{{ $product->id }}" class="addtocartdispensary btn appointment-btn ms-0 w-100">Add to cart</button>
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


                        </div>
                        <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="detail-about">
                                        <h3 class="left-content-head">About Us</h3>
                                        <div class="detail-about-content">
                                            {!! $detail->about !!}
                                        </div>
                                    </div>
                                    <div class="detail-customer">
                                        <h3 class="left-content-head">First-Time Customers</h3>
                                        <div class="detail-customer-content">
                                            {!! $detail->customers !!}
                                        </div>
                                    </div>

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
<!--                                    <h4 class="pb-4"><strong>Dispensary Name: </strong> {{ $dispensary->business_name }}</h4>
                                    <p><strong>Postal Code: </strong> {{ $dispensary->postal_code }}</p>
                                    <p><strong>City: </strong> {{ $dispensary->city }}</p>
                                    <p><strong>State/Province: </strong> {{ $dispensary->state_province }}</p>
                                    <p><strong>Country: </strong> {{ $dispensary->country }}</p>
                                    <p><strong>License No. </strong> {{ $dispensary->license_number }}</p>
                                    <p><strong>License Type: </strong> {{ $dispensary->license_type }}</p>-->
                                </div>
                                <div class="col-md-6">
                                    <div class="border">
                                        <iframe src="https://maps.google.com/maps?q=35.856737, 10.606619&z=15&output=embed" width="100%" height="300" frameborder="0" style="border:0"></iframe>
                                        <div class="row p-3">
                                            <div class="col-md-12 pb-3">
                                                <i class="fas fa-map-marker-alt"></i> &nbsp;&nbsp; {{ $dispensary->address_line_1 }}
                                            </div>
                                            <div class="col-md-12 pb-3">
                                                <i class="fas fa-phone-alt"></i> &nbsp;&nbsp; {{ $dispensary->phone_number }}
                                            </div>
                                            <div class="col-md-12 pb-3">
                                                <i class="fas fa-envelope"></i> &nbsp;&nbsp; {{ $dispensary->email }}
                                            </div>
                                            <div class="col-md-12 pb-3">
                                                <i class="fas fa-globe"></i> &nbsp;&nbsp; <a href="{{ $dispensary->website }}">{{ $dispensary->website }}</a>
                                            </div>
                                            <div class="col-md-12 pb-3 pt-3">
                                                <h6 class="text-danger">
                                                    <strong>
                                                        <?php
                                                            if ($dispensary->opening_time >= date('h:i') OR $dispensary->closing_time <= date('h:i')) {
                                                                echo "Open now!";
                                                            } else {
                                                                echo "Closed. Opens at " . $dispensary->opening_time;
                                                            }
                                                        ?>
                                                    </strong>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="row mt-5">
                                <?php
                                    $reviews = App\Models\RetailerReview::where('retailer_id', $dispensary->id)->get();
                                ?>
                                @if($reviews->count() > 0)
                                    @foreach($reviews as $review)
                                        @php
                                            $customer = App\Models\User::where('id', $review->customer_id)->select('name', 'profile')->first();
                                        @endphp
                                        <div class="col-md-6">
                                            <div class="card p-3 mb-4">
                                                <div class="row">
                                                    <div class="col-4">
                                                        @if($customer->profile == '')
                                                        <img src="{{ asset('dummy.png') }}" class="img-thumbnail" style="height: 80px;width: 80px;">
                                                        @else
                                                            <img src="{{ $customer->profile }}" class="img-thumbnail" style="height: 80px;width: 80px;">
                                                        @endif
                                                    </div>
                                                    <div class="col-8">
                                                        <h4><strong>{{ $customer->name }}</strong> <span style="    font-size: 14px;">({{ $review->created_at->diffForHumans() }})</span></h4>
                                                        <ul class="list-unstyled d-inline-flex">
                                                            <?php
                                                                if ($review['rating'] < 1) {
                                                                    echo '
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    ';
                                                                } elseif ($review['rating'] <= 1) {
                                                                    echo '
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    ';
                                                                } elseif ($review['rating'] > 1 AND $review['rating'] <=2) {
                                                                    echo '
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    ';
                                                                } elseif ($review['rating'] > 2 AND $review['rating'] <=3) {
                                                                    echo '
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    ';
                                                                } elseif ($review['rating'] > 3 AND $review['rating'] <=4) {
                                                                    echo '
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    ';
                                                                } elseif ($review['rating'] > 4 AND $review['rating'] <=5) {
                                                                    echo '
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    ';
                                                                }
                                                            ?>
                                                        </ul>
                                                        <p>{{ $review->description }}</p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12 text-center">
                                        No Reviews yet.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
