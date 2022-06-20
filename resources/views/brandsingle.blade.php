@extends('layouts.app')

    @section('title', '420 Finder')
    
    @section('content')

    <section class="pt-5" style="margin-top: 27px;">

        <div class="container-fluid mt-4">

            <div class="row">
                
                <div class="col-md-12 text-center brandSingleTopBanner" style="background-image: linear-gradient(0deg , rgb(0, 0, 0) 0%, rgba(0, 0, 0, 0) 100%), url('{{ $brand->cover }}');background-size: cover;background-position: center center;height: 400px;">

                    <div class="container text-start brandTitle">
                        <h1 class="text-white brandSingleTitle">{{ $brand->name }}</h1>
                        <div class="favBrand">
                            @if (Session::has('customer_id') == false)
                                <a href="{{ route('signin') }}"><i class="far fa-heart pe-4"></i></a>
                            @else
                                <a rel="{{ $brand->id }}" class="favbrand cursor-pointer"><i class="far fa-heart pe-4"></i></a>
                            @endif
                            <span class="followers"> 309 followers</span>
                        </div>
                    </div>

                </div>

            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs pt-3 brandSingleTabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="discover-tab" data-bs-toggle="tab" data-bs-target="#discover" type="button" role="tab" aria-controls="discover" aria-selected="true">Discover</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab" aria-controls="products" aria-selected="false">Contact Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="feeds-tab" data-bs-toggle="tab" data-bs-target="#feeds" type="button" role="tab" aria-controls="feeds" aria-selected="false">Feeds</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="retailers-tab" data-bs-toggle="tab" data-bs-target="#retailers" type="button" role="tab" aria-controls="retailers" aria-selected="false">Retailers</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="discover" role="tabpanel" aria-labelledby="discover-tab">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h4 class="mb-3"><strong>Featured Products</strong></h4>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    @if($featuredproducts->count() > 0)
                                        @foreach($featuredproducts as $featured)
                                            <div class="col-md-3 col-6 mb-4 cursor-pointer" onclick="location.href='{{ route('brandproductsingle', ['slug' => $featured['slug'], 'id' => encrypt($featured->id)]) }}';">
                                                <div class="card shadow-sm">
                                                  <img src="{{ $featured->image }}" class="card-img-top" alt="...">
                                                  <div class="card-body pt-1 border-top">
                                                    <div style="font-size: 1rem;font-weight: 700;letter-spacing: 0.00625rem;line-height: 1.25rem;padding-top: 10px">{{ substr($featured->name, 0, 20) }}...</div>
                                                    <div class="py-2" style="font-weight: 400;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;">{{ $featured->subcategory_names }}</div>
                                                    <ul class="list-unstyled d-flex ratings">
                                                        <?php

                                                            if (count($featured['reviews']) > 0) {

                                                                $sum = 0;
                                                                foreach ($featured['reviews'] as $review) {
                                                                    
                                                                    $sum = $sum + $review['rating'];

                                                                }
                                                                $totalratings = $sum / count($featured['reviews']);

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

                                                            echo " <span class='reviewCount'>(".count($featured['reviews']).")</span>";

                                                        ?>
                                                    </ul>
                                                  </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <h4 class="mb-3"><strong>Recent Products</strong></h4>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    @if($products->count() > 0)
                                        @foreach($products as $product)
                                            <div class="col-md-3 col-6 mb-4 mb-4 cursor-pointer" onclick="location.href='{{ route('brandproductsingle', ['slug' => $product['slug'], 'id' => encrypt($product->id)]) }}';">
                                                <div class="card shadow-sm">
                                                  <img src="{{ $product->image }}" class="card-img-top" alt="...">
                                                  <div class="card-body pt-1 border-top">
                                                    <div style="font-size: 1rem;font-weight: 700;letter-spacing: 0.00625rem;line-height: 1.25rem;padding-top: 10px">{{ substr($product->name, 0, 20) }}...</div>
                                                    <div class="py-2" style="font-weight: 400;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;">{{ $product->subcategory_names }}</div>
                                                    <ul class="list-unstyled d-flex ratings">
                                                        <?php

                                                            if (count($product['reviews']) > 0) {

                                                                $sum = 0;
                                                                foreach ($product['reviews'] as $review) {
                                                                    
                                                                    $sum = $sum + $review['rating'];

                                                                }
                                                                $totalratings = $sum / count($product['reviews']);

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

                                                            echo " <span class='reviewCount'>(".count($product['reviews']).")</span>";

                                                        ?>
                                                    </ul>
                                                  </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <h4 class="pt-4"><strong>About</strong></h4>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card px-4 py-2 shadow-sm">
                                            <?php echo $brand->description; ?>
                                            <div class="border-top pt-4 mt-4">
                                                <p><strong>License Type: </strong>{{ $brand->license_type }}</p>
                                                <p><strong>License Number: </strong>{{ $brand->license_number }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
                                <div class="row mt-4">
                                    <div class="col-md-4 mb-5">
                                        <h4 class="mb-3"><strong>Contact Details</strong></h4>
                                        <div class="card shadow-sm p-4">
                                            <ul class="list-unstyled">
                                                <li class="pb-3 border-bottom mb-3">
                                                    <i class="fas fa-laptop-house"></i>&nbsp;&nbsp; {{ $brand['business']['business_name'] }}
                                                </li>
                                                <li class="pb-3 border-bottom mb-3">
                                                    <i class="fas fa-phone"></i>&nbsp;&nbsp; {{ $brand['business']['phone_number'] }}
                                                </li>
                                                <li class="pb-3 border-bottom mb-3">
                                                    <i class="far fa-envelope"></i>&nbsp;&nbsp; {{ $brand['business']['email'] }}
                                                </li>
                                                <li class="pb-3">
                                                    <i class="fas fa-sitemap"></i>&nbsp;&nbsp; {{ $brand['business']['business_type'] }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="mb-3"><strong>Address</strong></h4>
                                        <div class="card shadow-sm p-4">
                                            <ul class="list-unstyled">
                                                <li class="pb-3 border-bottom mb-3">
                                                    <strong>Country: </strong>&nbsp;&nbsp; {{ $brand['business']['country'] }}
                                                </li>
                                                <li class="pb-3 border-bottom mb-3">
                                                    <strong>Address line 1: </strong>&nbsp;&nbsp; {{ $brand['business']['address_line_1'] }}
                                                </li>
                                                <li class="pb-3 border-bottom mb-3">
                                                    <strong>Address line 2: </strong>&nbsp;&nbsp; {{ $brand['business']['address_line_2'] }}
                                                </li>
                                                <li class="pb-3 border-bottom mb-3">
                                                    <strong>City: </strong>&nbsp;&nbsp; {{ $brand['business']['city'] }}
                                                </li>
                                                <li class="pb-3 border-bottom mb-3">
                                                    <strong>State/Province: </strong>&nbsp;&nbsp; {{ $brand['business']['state_province'] }}
                                                </li>
                                                <li class="pb-3">
                                                    <strong>Postal code: </strong>&nbsp;&nbsp; {{ $brand['business']['postal_code'] }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="feeds" role="tabpanel" aria-labelledby="feeds-tab">
                                <div class="row mt-4">
                                    <div class="col-md-4 mb-5">
                                        <h4 class="mb-3"><strong>Social</strong></h4>
                                        <div class="card shadow-sm p-4">
                                            <ul class="list-unstyled">
                                                @if($brand->facebook_url != NULL)
                                                <li class="pb-3 border-bottom mb-3">
                                                    <a href="{{ $brand->facebook_url }}" target="_blank"><i class="fab fa-facebook-f"></i>&nbsp;&nbsp; Facebook</a>
                                                </li>
                                                @endif
                                                @if($brand->twitter_url != NULL)
                                                <li class="pb-3 border-bottom mb-3">
                                                    <a href="{{ $brand->twitter_url }}" target="_blank"><i class="fab fa-twitter"></i>&nbsp;&nbsp; Twitter</a>
                                                </li>
                                                @endif
                                                @if($brand->instagram_url != NULL)
                                                <li class="pb-3 border-bottom mb-3">
                                                    <a href="{{ $brand->instagram_url }}" target="_blank"><i class="fab fa-instagram"></i>&nbsp;&nbsp; Instagram</a>
                                                </li>
                                                @endif
                                                @if($brand->website_url != NULL)
                                                <li class="pb-3 border-bottom mb-3">
                                                    <a href="{{ $brand->website_url }}" target="_blank"><i class="fas fa-link"></i>&nbsp;&nbsp; Website</a>
                                                </li>
                                                @endif
                                                @if($brand->yt_featured_url != NULL)
                                                <li class="pb-3 border-bottom mb-3">
                                                    <a href="{{ $brand->yt_featured_url }}" target="_blank"><i class="fab fa-youtube"></i>&nbsp;&nbsp; Youtube Video</a>
                                                </li>
                                                @endif
                                                @if($brand->yt_playlist_url != NULL)
                                                <li class="pb-3">
                                                    <a href="{{ $brand->yt_playlist_url }}" target="_blank"><i class="fab fa-youtube-square"></i>&nbsp;&nbsp; Youtube Playlist</a>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="mb-3"><strong>Latest Posts</strong></h4>
                                        @if($feeds->count() > 0)
                                            <div class="row">
                                                @foreach($feeds as $feed)
                                                    <div class="col-md-6 mb-4">
                                                        <div class="shadow-sm" style="border: 1px solid #f3ebeb;">
                                                            <div class="row p-3">
                                                                <div class="col-md-12 d-flex">
                                                                    <img src="{{ $brand->logo }}" alt="{{ $brand->name }}" style="width: 40px;height: 40px;">
                                                                    <h5 class="pt-1 ps-2" style="font-weight: 600;font-size: 1.25rem;line-height: 1.5rem;">{{ $brand->name }}</h5>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <img src="{{ $feed->image }}" alt="" class="w-100">
                                                            </div>
                                                            <div class="p-3 pb-0">
                                                                {{ $feed->description }}
                                                            </div>
                                                            <div class="row p-3">
                                                                <div class="col-md-6 border-top pt-3">
                                                                    <button class="bg-transparent border-0"><i class="far fa-heart"></i> Like</button>
                                                                </div>
                                                                <div class="col-md-6 text-end border-top pt-3">
                                                                    {{ $feed->created_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="row pt-5 mt-5">
                                                <div class="border col-md-8 offset-md-2 p-5 shadow-sm text-center">
                                                    <h5><strong>No posts yet</strong></h5>
                                                    <p>High Tide Organics currently doesn't have any posts. Please check back later!</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="retailers" role="tabpanel" aria-labelledby="retailers-tab">...</div>
                        </div>
                    </div>
                </div>
            </div>    

        </div>

    </section>

@endsection