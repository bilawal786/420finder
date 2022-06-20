@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <?php
        function distance($lat1, $lon1, $lat2, $lon2, $unit) {

          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($unit);

          if ($unit == "K") {
              return ($miles * 1.609344);
          } else if ($unit == "N") {
              return ($miles * 0.8684);
          } else {
              return $miles;
          }
        }


    ?>

    <!-- ======= Hero Section ======= -->
    @if (count($slidesdesktop) > 0)
    <section class="hero-section">
        <div class="container px-0">

            <!-- For Desktop -->

            <div id="carouselDesktop" class="carousel slide forDesktop" data-bs-ride="carousel">

                <div class="carousel-indicators">

                    @if(count($slidesdesktop) > 0)

                        @foreach($slidesdesktop as $index => $single)

                            @if($index < 5)

                                <button type="button" data-bs-target="#carouselDesktop" data-bs-slide-to="{{ $index }}" class="@if($index == 0) active @endif" @if($index == 0) aria-current="true" @endif aria-label="Slide {{ $index }}"></button>

                            @endif

                        @endforeach

                    @endif

                </div>

                <div class="carousel-inner">
                    @if(count($slidesdesktop) > 0)


                        @foreach($slidesdesktop as $index => $slide)

                        <?php
                           $images = json_decode($slide->slide, true);
                          ?>
                            @if($index < 5)
                                {{-- <a href="{{ $slide->url }}" target="_blank"> --}}
                                <div class="carousel-item @if($index == 0) active @endif">

                                    <img src="{{ $images['desktop'] }}" class="d-block w-100 br-30" alt="..." onclick="location.href = '{{ $slide->url }}'" style="cursor: pointer;">

                                </div>
                                 {{-- </a> --}}
                            @endif

                        @endforeach

                    @endif

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDesktop" data-bs-slide="prev">

                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>

                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselDesktop" data-bs-slide="next">

                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>

                </button>

            </div>

            <!-- For Mobile -->
            <div id="carouselMobile" class="carousel slide forMobile" data-bs-ride="carousel">

                <div class="carousel-indicators">

                    {{-- @if(count($slidesmobile) > 0)

                        @foreach($slidesmobile as $index => $single) --}}

                        @if(count($slidesdesktop) > 0)

                        @foreach($slidesdesktop as $index => $single)


                            @if($index < 5)

                                <button type="button" data-bs-target="#carouselMobile" data-bs-slide-to="{{ $index }}" class="@if($index == 0) active @endif" @if($index == 0) aria-current="true" @endif aria-label="Slide {{ $index }}"></button>

                            @endif

                        @endforeach

                    @endif

                </div>

                <div class="carousel-inner">

                        @if(count($slidesdesktop) > 0)

                        @foreach($slidesdesktop as $index => $slide)

                        <?php
                           $images = json_decode($slide->slide, true);
                          ?>

                            @if($index < 5)
                                    <div class="carousel-item @if($index == 0) active @endif">

                                        <img src="{{ $images['mobile'] }}" class="d-block w-100" alt="..." onclick="location.href = '{{ $slide->url }}'" style="cursor: pointer;">
                                    </div>
                            @endif

                        @endforeach

                    @endif

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselMobile" data-bs-slide="prev">

                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>

                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselMobile" data-bs-slide="next">

                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>

                </button>

            </div>


        </div>
    </section><!-- End Hero -->
    @endif

    {{-- TOP BUSINESSES --}}
    @if(count($topBusinesses) > 0)
    <section class="fiveCols forRating common-section top-business-section {{ count($slidesdesktop) < 1 ? 'top-10' : '' }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-8">
                    <h5 style="font-weight: 600;">Top Businesses</h5>
                </div>
                <div class="col-md-4 col-4 text-end">
                    <a href="{{ route('deliveries') }}" style="font-weight: 600;">View all ></a>
                </div>
            </div>

            @if(count($topBusinesses) > 0)

            <div class="row mobileCarasoulTop">
                <div id="top-slider" class="owl-carousel">

                        @foreach($topBusinesses as $topBusiness)
                            <div class="post-slide">
                              <div class="top-business-img post-img">
                                @if($topBusiness->profile_picture == 'https://jeremiahc1.sg-host.com/assets/img/logo.png')
                                    <div style="width: auto; height: 238px;" class="bg-light defaultImage">
                                        <img src="{{ asset('assets/img/logo.png') }}" class="card-img-top" alt="..." style="opacity: 0.3;padding-top: 60px;padding-left: 20px;padding-right: 20px;">
                                    </div>
                                @elseif($topBusiness->profile_picture == '')
                                    <div style="width: auto; height: 238px;" class="bg-light defaultImage">
                                        <img src="{{ asset('assets/img/logo.png') }}" class="card-img-top" alt="..." style="opacity: 0.3;padding-top: 60px;padding-left: 20px;padding-right: 20px;">
                                    </div>
                                @else
                                    <img src="{{ $topBusiness->profile_picture }}" class="card-img-top" style="width: auto; height: 238px;">
                                @endif
                                <a href="{{ route('deliverysingle', ['name' => $topBusiness->business_name, 'id' => $topBusiness->id]) }}" class="over-layer">
                                    <i class="far fa-heart heartIcon"></i>

                                    <img src="{{ $topBusiness->icon }}" class="markerImageIcon">

                                </a>
                                <div class="rank-badge">
                                    <span>#{{ $loop->iteration }}</span>
                                </div>

                              </div>
                              <div class="post-content">
                                    <div class="card-body pt-1 mobilePaddingZero">
                                        <div class="address-line">
                                            {{ $topBusiness->address_line_1 }} |
                                            <span style="font-size: 10px;font-weight: 100;">
                                            <?php

                                                $latitude = '';
                                                $longitude = '';

                                                if(Session::has('latitude') && Session::has('longitude')) {
                                                    $latitude = session('latitude');
                                                    $longitude = session('longitude');
                                                } else {
                                                    $latitude = "34.0201613";
                                                    $longitude = "-118.6919234";
                                                }

                                                echo round(distance($latitude, $longitude, $topBusiness->latitude, $topBusiness->longitude, 'M')); ?> mi</span>
                                        </div>

                                        <div class="address-title">

                                            @if ($topBusiness->business_type == 'Delivery')
                                            <a href="{{ route('deliverysingle', ['name' => $topBusiness->business_name, 'id' => $topBusiness->id]) }}" class="retailerTitle">
                                                {{ $topBusiness->business_name }}
                                            </a>
                                            @elseif($topBusiness->business_type == 'Dispensary')
                                            <a href="{{ route('dispensarysingle', ['name' => $topBusiness->business_name, 'id' => $topBusiness->id]) }}" class="retailerTitle">
                                                {{ $topBusiness->business_name }}
                                            </a>

                                            @endif

                                        </div>

                                        <div style="font-weight: 400;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;">
                                            {{ $topBusiness->license_type }}
                                        </div>
                                        <?php
                                            $reviews = App\Models\RetailerReview::where('retailer_id', $topBusiness->id)->get();

                                                if (count($reviews) > 0) {

                                                    $sum = 0;
                                                    foreach ($reviews as $review) {

                                                        $sum = $sum + $review->rating;

                                                    }
                                                    $totalratings = $sum / $reviews->count();

                                                } else {
                                                    $totalratings = 0;
                                                }

                                            ?>

                                        <div class="rating-wrap">
                                            <div class="index-rating" data-rating="{{ $totalratings }}"></div>
                                            <div class="reviewAvgCount">
                                                <span>{{ number_format($totalratings, 1) }}</span>
                                                <span>({{ count($reviews) }})</span>
                                            </div>
                                        </div>

                                        <div>

                                        @if ($topBusiness->business_type == 'Delivery')
                                        <a href="{{ route('deliverysingle', ['name' => $topBusiness->business_name, 'id' => $topBusiness->id]) }}" class="retailerOrderBtn order-pickup-btn"><i class="fas fa-shopping-cart"></i> <span>Order for Delivery</span></a>
                                        @elseif($topBusiness->business_type == 'Dispensary')
                                        <a href="{{ route('deliverysingle', ['name' => $topBusiness->business_name, 'id' => $topBusiness->id]) }}" class="retailerOrderBtn order-pickup-btn"><i class="fas fa-shopping-cart"></i> <span>Order for Pickup</span></a>
                                        @endif
                                        </div>
                                    </div>
                              </div>
                            </div>
                        @endforeach

                </div>
            </div>
            @else
            <div class="row no-record-found">
                {{-- <div class="col-md-1 col-1">
                    <img src="{{ asset('images/not-found.svg') }}" alt="">
                </div> --}}
                <div class="col-md-11 col-11">
                    <h3>No Top 10 Businesses in your area.</h3>
                </div>
            </div>
           @endif
        </div>
    </section>
    @endif

    {{-- DELIVERIES --}}
    @if(count($deliveries) > 0)
    <section class="fiveCols forRating common-section delivery-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-8">
                    <h5 style="font-weight: 600;">Delivery Services</h5>
                </div>
                <div class="col-md-4 col-4 text-end">
                    <a href="{{ route('deliveries') }}" style="font-weight: 600;">View all ></a>
                </div>
            </div>

            @if(count($deliveries) > 0)
            <div class="row mobileCarasoulTop">
                <div id="news-slider1" class="owl-carousel">

                        @foreach($deliveries as $index => $delivery)
                            <div class="post-slide">
                              <div class="post-img">
                                @if($delivery->profile_picture == 'https://jeremiahc1.sg-host.com/assets/img/logo.png')
                                    <div style="width: auto; height: 238px;" class="bg-light defaultImage">
                                        <img src="{{ asset('assets/img/logo.png') }}" class="card-img-top" alt="..." style="opacity: 0.3;padding-top: 60px;padding-left: 20px;padding-right: 20px;">
                                    </div>
                                @elseif($delivery->profile_picture == '')
                                    <div style="width: auto; height: 238px;" class="bg-light defaultImage">
                                        <img src="{{ asset('assets/img/logo.png') }}" class="card-img-top" alt="..." style="opacity: 0.3;padding-top: 60px;padding-left: 20px;padding-right: 20px;">
                                    </div>
                                @else
                                    <img src="{{ $delivery->profile_picture }}" class="card-img-top" style="width: auto; height: 238px;">
                                @endif
                                <a href="{{ route('deliverysingle', ['name' => $delivery->business_name, 'id' => $delivery->id]) }}" class="over-layer">
                                    <i class="far fa-heart heartIcon"></i>
                                    {{-- @if($index == 0)
                                        <img src="{{ asset('images/icons/icondelivery.png') }}" class="markerImageIcon">
                                    @elseif($index == 1)
                                        <img src="{{ asset('images/icons/icondispensary.png') }}" class="markerImageIcon">
                                    @elseif($index == 2)
                                        <img src="{{ asset('images/icons/icondelivery.png') }}" class="markerImageIcon">
                                    @elseif($index == 3)
                                        <img src="{{ asset('images/icons/icondispensary.png') }}" class="markerImageIcon">
                                    @elseif($index == 4)
                                        <img src="{{ asset('images/icons/icondelivery.png') }}" class="markerImageIcon">
                                    @elseif($index == 5)
                                        <img src="{{ asset('images/icons/icondispensary.png') }}" class="markerImageIcon">
                                    @elseif($index == 6)
                                        <img src="{{ asset('images/icons/icondelivery.png') }}" class="markerImageIcon">
                                    @elseif($index == 7)
                                        <img src="{{ asset('images/icons/icondispensary.png') }}" class="markerImageIcon">
                                    @elseif($index == 8)
                                        <img src="{{ asset('images/icons/icondelivery.png') }}" class="markerImageIcon">
                                    @elseif($index == 9)
                                        <img src="{{ asset('images/icons/icondispensary.png') }}" class="markerImageIcon">
                                    @endif --}}
                                    <img src="{{ asset('images/icons/icondelivery.png') }}" class="markerImageIcon">
                                </a>
                              </div>
                              <div class="post-content">
                                    <div class="card-body pt-1 mobilePaddingZero">
                                        <div class="address-line">
                                            {{ $delivery->address_line_1 }} |
                                            <span style="font-size: 10px;font-weight: 100;">
                                            <?php

                                                $latitude = '';
                                                $longitude = '';

                                                if(Session::has('latitude') && Session::has('longitude')) {
                                                    $latitude = session('latitude');
                                                    $longitude = session('longitude');
                                                } else {
                                                    $latitude = "34.0201613";
                                                    $longitude = "-118.6919234";
                                                }

                                                echo round(distance($latitude, $longitude, $delivery->latitude, $delivery->longitude, 'M')); ?> mi</span>
                                        </div>

                                        <div class="address-title">
                                            <a href="{{ route('deliverysingle', ['name' => $delivery->business_name, 'id' => $delivery->id]) }}" class="retailerTitle">
                                                {{ $delivery->business_name }}
                                            </a>
                                        </div>

                                        <div style="font-weight: 400;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;">
                                            {{ $delivery->license_type }}
                                        </div>
                                        <?php
                                            $reviews = App\Models\RetailerReview::where('retailer_id', $delivery->id)->get();

                                                if (count($reviews) > 0) {

                                                    $sum = 0;
                                                    foreach ($reviews as $review) {

                                                        $sum = $sum + $review->rating;

                                                    }
                                                    $totalratings = $sum / $reviews->count();

                                                } else {
                                                    $totalratings = 0;
                                                }

                                            ?>
                                         <div class="rating-wrap">
                                            <div class="index-rating" data-rating="{{ $totalratings }}"></div>
                                            <div class="reviewAvgCount">
                                                <span>{{ number_format($totalratings, 1) }}</span>
                                                <span>({{ count($reviews) }})</span>
                                            </div>
                                        </div>

                                        <div>
                                        <a href="{{ route('deliverysingle', ['name' => $delivery->business_name, 'id' => $delivery->id]) }}" class="retailerOrderBtn order-pickup-btn"><i class="fas fa-shopping-cart"></i> <span>Order for Delivery</span></a>
                                        </div>
                                    </div>
                              </div>
                            </div>
                        @endforeach

                </div>
            </div>
            @else
            <div class="row no-record-found">
                {{-- <div class="col-md-1 col-1">
                    <img src="{{ asset('images/not-found.svg') }}" alt="">
                </div> --}}
                <div class="col-md-11 col-11">
                    <h3>No Deliveries in your area.</h3>
                </div>
            </div>
           @endif
        </div>
    </section>
    @endif

    @if (count($dispensaries) > 0)
    {{-- DISPENSARIES --}}
    <section class="fiveCols py-0 forRating dispensaries-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-8">
                    <h5 style="font-weight: 600;">Dispensary storefronts</h5>
                </div>
                <div class="col-md-4 col-4 text-end">
                    <a href="{{ route('dispensaries') }}" style="font-weight: 600;">View all ></a>
                </div>
            </div>

            <div class="row mobileCarasoulTop">
                <div id="news-slider2" class="owl-carousel">

                    @if(count($dispensaries) > 0)
                        @foreach($dispensaries as $index => $dispensary)
                            <div class="post-slide">
                              <div class="post-img">

                                @if($dispensary->profile_picture == 'https://jeremiahc1.sg-host.com/assets/img/logo.png')
                                    <div style="width: auto; height: 238px;" class="bg-light defaultImage">
                                        <img src="{{ asset('assets/img/logo.png') }}" class="card-img-top" alt="..." style="opacity: 0.3;padding-top: 60px;padding-left: 20px;padding-right: 20px;">
                                    </div>
                                @elseif($dispensary->profile_picture == '')
                                <div style="width: auto; height: 238px;" class="bg-light defaultImage">
                                    <img src="{{ asset('assets/img/logo.png') }}" class="card-img-top" alt="..." style="opacity: 0.3;padding-top: 60px;padding-left: 20px;padding-right: 20px;">
                                </div>
                                @else
                                    <img src="{{ $dispensary->profile_picture }}" class="card-img-top" style="width: auto; height: 238px;">
                                @endif
                                <a href="{{ route('dispensarysingle', ['name' => $dispensary->business_name, 'id' => $dispensary->id]) }}" class="over-layer">
                                    <i class="far fa-heart heartIcon"></i>
                                    {{-- @if($index == 0)
                                        <img src="{{ asset('images/icons/icondelivery.png') }}" class="markerImageIcon">
                                    @elseif($index == 1)
                                        <img src="{{ asset('images/icons/icondispensary.png') }}" class="markerImageIcon">
                                    @elseif($index == 2)
                                        <img src="{{ asset('images/icons/icondelivery.png') }}" class="markerImageIcon">
                                    @elseif($index == 3)
                                        <img src="{{ asset('images/icons/icondispensary.png') }}" class="markerImageIcon">
                                    @elseif($index == 4)
                                        <img src="{{ asset('images/icons/icondelivery.png') }}" class="markerImageIcon">
                                    @elseif($index == 5)
                                        <img src="{{ asset('images/icons/icondispensary.png') }}" class="markerImageIcon">
                                    @elseif($index == 6)
                                        <img src="{{ asset('images/icons/icondelivery.png') }}" class="markerImageIcon">
                                    @elseif($index == 7)
                                        <img src="{{ asset('images/icons/icondispensary.png') }}" class="markerImageIcon">
                                    @elseif($index == 8)
                                        <img src="{{ asset('images/icons/icondelivery.png') }}" class="markerImageIcon">
                                    @elseif($index == 9)
                                        <img src="{{ asset('images/icons/icondispensary.png') }}" class="markerImageIcon">
                                    @endif --}}
                                    <img src="{{ asset('images/icons/icondispensary.png') }}" class="markerImageIcon">
                                </a>
                              </div>
                              <div class="post-content">
                                    <div class="card-body pt-1 mobilePaddingZero">
                                        <div style="font-weight: 400;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;padding-top: 10px;">
                                            {{  $dispensary->city }},
                                            {{  $dispensary->state_province  }}
                                            |
                                            <span style="font-size: 10px;font-weight: 100;">
                                            <?php

                                                $latitude = '';
                                                $longitude = '';

                                                if(Session::has('latitude') && Session::has('longitude')) {
                                                    $latitude = session('latitude');
                                                    $longitude = session('longitude');
                                                } else {
                                                    $latitude = "34.0201613";
                                                    $longitude = "-118.6919234";
                                                }

                                                echo round(distance($latitude, $longitude, $dispensary->latitude, $dispensary->longitude, 'M')); ?> mi</span></div>
                                        <div style="font-size: 1rem;font-weight: 700;letter-spacing: 0.00625rem;line-height: 1.25rem;" class="retailerTitle">{{ $dispensary->business_name }}
                                        </div>
                                        <div style="font-weight: 400;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;">{{ $dispensary->license_type }}</div>
                                        <?php
                                            $reviews = App\Models\RetailerReview::where('retailer_id', $dispensary->id)->get();

                                                if (count($reviews) > 0) {

                                                    $sum = 0;
                                                    foreach ($reviews as $review) {

                                                        $sum = $sum + $review->rating;

                                                    }
                                                    $totalratings = $sum / $reviews->count();

                                                } else {
                                                    $totalratings = 0;
                                                }

                                            ?>
                                             <div class="rating-wrap">
                                                <div class="index-rating" data-rating="{{ $totalratings }}"></div>
                                                <div class="reviewAvgCount">
                                                    <span>{{ number_format($totalratings, 1) }}</span>
                                                    <span>({{ count($reviews) }})</span>
                                                </div>
                                            </div>

                                        <a href="{{ route('dispensarysingle', ['name' => $dispensary->business_name, 'id' => $dispensary->id]) }}" class="retailerOrderBtn order-pickup-btn"><i class="fas fa-shopping-cart"></i> <span>Order for Pickup</span></a>
                                    </div>
                              </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row no-record-found">
                            {{-- <div class="col-md-1 col-1">
                                <img src="{{ asset('images/not-found.svg') }}" alt="">
                            </div> --}}
                            <div class="col-md-11 col-11">
                                <h3>No Dispensaries in your area.</h3>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- DEALS NEAR BY --}}

    <section class="p-0 deals-section" id="productsonsale">

        <div class="container">

            <div class="row">

                <h4 class="mb-4">
                    <strong>Deals nearby</strong>
                </h4>
                <div class="row">

                    @if(count($businesses) > 0)

                    <?php
                        $businessIds = [];
                        foreach($businesses as $business) {
                           array_push($businessIds, $business->id);
                        }
                      ?>
                            <?php
                                $deals = \App\Models\Deal::whereIn('retailer_id', $businessIds)
                                    ->get();
                                ?>

                                @forelse ($deals as $deal)
                                <a href="{{ route('dealsingle', ['id' => $deal->id]) }}" class="col-md-3 col-6 mb-3 cursor-pointer">

                                    <div class="card">
                                        @if($deal->percentage > 0)
                                            <label class="label-off">{{ $deal->percentage }}% off</label>
                                        @endif
                                        <div>
                                            <img src="{{ json_decode($deal->picture)[0] }}" class="card-img-top" alt="...">
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
                                </a>
                                @empty
                                    <div class="row no-record-found no-record-found-deal">
                                        {{-- <div class="col-md-1 col-1">
                                            <img src="{{ asset('images/not-found.svg') }}" alt="">
                                        </div> --}}
                                        <div class="col-md-11 col-11">
                                            <h3>THERE ARE NO DEALS IN YOUR AREA AT THIS TIME. CHECK BACK AGAIN SOON!</h3>
                                        </div>
                                    </div>
                                @endforelse
                    @else
                        <div class="row no-record-found no-record-found-deal">
                            {{-- <div class="col-md-1 col-1">
                                <img src="{{ asset('images/not-found.svg') }}" alt="">
                            </div> --}}
                            <div class="col-md-11 col-11">
                                <h3>THERE ARE NO DEALS IN YOUR AREA AT THIS TIME. CHECK BACK AGAIN SOON!</h3>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </section>

    {{-- RECENTLY VIEWED --}}
    {{-- <section class="p-0 mt-5" id="productsonsale">

        <div class="container">

            <div class="row">

                <h4 class="mb-4">
                    <strong>Recently Viewed</strong>
                </h4>

                <div class="row">

                    @if(count($recentlyvieweds) > 0)

                        @foreach($recentlyvieweds as $recent)

                            @if($recent->type == 'Dispensary')

                                <?php
                                    $product = App\Models\DispenseryProduct::where('id', $recent->product_id)->first();
                                ?>

                                <div class="col-md-3 col-6 mb-3 cursor-pointer" onclick="location.href='{{ route("retailerproduct", ["business_type" => $recent->type, "slug" => $product->slug, "product_id" => $product->id]) }}';">

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

                            @else

                                <?php
                                    $product = App\Models\DeliveryProducts::where('id', $recent->product_id)->first();
                                ?>

                                <div class="col-md-3 col-6 mb-3 cursor-pointer" onclick="location.href='{{ route("retailerproduct", ["business_type" => $recent->type, "slug" => $product->slug, "product_id" => $product->id]) }}';">

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
                                                @if (Session::has('customer_id') == false)
                                                    <a class="btn appointment-btn ms-0 w-100" href="{{ route('signin') }}">Add to cart</a>
                                                @else
                                                    <button rel="{{ $product->id }}" class="btn appointment-btn ms-0 w-100 addtocartdelivery">Add to cart</button>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            @endif

                        @endforeach

                    @else
                        <div class="row no-record-found">
                            {{-- <div class="col-md-1 col-1">
                                <img src="{{ asset('images/not-found.svg') }}" alt="">
                            </div> --}}
                            {{-- <div class="col-md-11 col-11">
                                <h3>No Recently Viewed Products.</h3>
                            </div>
                        </div>
                    @endif

                </div>

            </div>

        </div>

    </section> --}}

    @if (count($middleslidesdesktop) > 0)
    <section class="container forMobilePadding">

        <div class="row">
            @foreach($middleslidesdesktop as $index => $slide)
             <?php
                    $images = json_decode($slide->slide, true);
                ?>
                <a href="{{ $slide->url }}" class="col-6 forDesktop mb-5">
                    <img src="{{ $images['desktop'] }}" class="w-100 shadow" onclick="{{ $slide->url }}" style="cursor: pointer;">
                </a>
            @endforeach
        </div>

        <div class="row">
            {{-- @foreach($middleslidesmobile as $index => $slide)
                <a href="{{ $slide->url }}" class="col-12 forMobile mb-3">
                    <img src="{{ $slide->slide  }}" class="w-100 shadow" style="height: 200px;">
                </a>
            @endforeach --}}
            @foreach($middleslidesdesktop as $index => $slide)
                <?php
                 $images = json_decode($slide->slide, true);
                 ?>

            <a href="{{ $slide->url }}" class="col-12 forMobile mb-3">
                <img src="{{ $images['mobile'] }}" class="w-100 shadow" style="height: 200px;">
            </a>
        @endforeach
        </div>

    </section>
    @endif

    {{-- BROWSE BY CATEGORY --}}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-8">
                    <h5 style="font-weight: 600;" class="pb-2">Browse by category</h5>
                </div>
                <div class="col-md-4 col-4 text-end">
                    <a href="{{ route('categories') }}" style="font-weight: 600;">View all ></a>
                </div>
            </div>
            <div class="row">
                @if($categories->count() > 0)
                    @foreach($categories as $category)
                        <a href="{{ route('categorywisewise', ['catname' => $category['slug']]) }}" class="col-md-3 col-6 mb-3">
                            <div class="card border shadow-sm">
                              <img src="{{ $category->image }}" class="card-img-top" alt="...">
                              <div class="card-body pt-1">
                                <div style="font-size: 1rem;letter-spacing: 0.00625rem;line-height: 2.25rem;text-align: center;">{{ $category->name }}</div>
                              </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- CREATE ACCOUNT --}}
    <section style="background: #F8971C;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class="text-white">Create your account to get started.</h3>
                    <a href="{{ route('signup') }}" class="btn btn-light">Sign up</a>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/star-rating/star-rating-svg.css') }}">
@endsection
@push('scripts')
    <script type="application/javascript" src="{{ asset('assets/js/star-rating/jquery.star-rating-svg.js') }}"></script>
    <script>
    $(".index-rating").starRating({
        readOnly: true,
        totalStars: 5,
        starSize: 18,
        emptyColor: 'lightgray',
        activeColor: '#f8971c',
        useGradient: false
      });
    </script>
@endpush
