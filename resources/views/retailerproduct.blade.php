@extends('layouts.app')

    @section('Categories', ' | 420 Finder')

    @section('content')

    <section class="py-0" style="margin-top: 100px;">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4">
                    <img id="productFeatured" src="{{ $product->image }}" alt="{{ $product->name }}" class="w-100 img-thumbnail">
                    <ul class="list-unstyled row mt-2" style="flex-wrap: inherit;overflow-x: auto;">
                        @if($gallery->count() >0)
                            @foreach($gallery as $single)
                                <li class="col-md-3">
                                    <img src="{{ $single->image }}" alt="" class="w-100 img-thumbnail cursor-pointer galleryImage">
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-8">
                    <h2 style="line-height: 1.5;margin-bottom: 0;"><strong>{{ $product->name }}</strong></h2>
                    <p><strong>Category : </strong>
                        <?php
                            $category = App\Models\Category::where('id', $product->category_id)->select('name')->first();
                            echo $category->name;
                        ?>
                    </p>
                    <ul class="list-unstyled d-flex ratings">
                        <?php

                            if ($reviews->count() > 0) {

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

                            echo " <span class='reviewCount'> (". $reviews->count() .")</span>";

                        ?>
                    </ul>
                    <div class="row mt-4">
                        @if($product->thc_percentage != '')
                        <div class="col-md-12">
                            <p><strong>THC : </strong>{{ $product->thc_percentage }}%</p>
                        </div>
                        @endif
                        @if($product->cbd_percentage != '')
                        <div class="col-md-12">
                            <p><strong>CBD : </strong>{{ $product->cbd_percentage }}%</p>
                        </div>
                        @endif
                        <div class="col-md-12">
                            <p><strong>Strain : </strong>
                                <?php
                                    $strain = App\Models\Strain::where('id', $product->strain_id)->select('name')->first();

                                    echo $strain->name;
                                ?>
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p><strong>Genetic : </strong>
                                <?php
                                    $genetic = App\Models\Genetic::where('id', $product->genetic_id)->select('name')->first();

                                    echo $genetic->name;
                                ?>
                            </p>
                        </div>
                        <div class="col-md-12">
                            <h3><strong>${{ $product->price }}</strong> <span class="text-black-50" style="font-size: 14px;">each</span></h3>
                        </div>
                        <div class="col-md-12 mt-4 d-flex">
                            @if($retailer->business_type == 'Delivery')
                                <button rel="{{ $product->id }}" class="btn appointment-btn ms-0 product-single-delivery-cart">Add to cart</button>
                            @else
                                <button rel="{{ $product->id }}" class="addtocartdispensary btn appointment-btn ms-0">Add to cart</button>
                            @endif
                            <div class="favBrand">
                                @if (Session::has('customer_id') == false)
                                    <a href="{{ route('signin') }}"><i class="far fa-heart pe-4 shadow ms-3"></i></a>
                                @else
                                    <input type="hidden" id="retailer_id" value="{{ $retailer->business_type }}">
                                    <a rel="{{ $retailer->id }}" class="favretailerproduct cursor-pointer"><i class="far fa-heart pe-4 shadow ms-3"></i></a>
                                @endif
                                <span class="followers"> 309 followers</span>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 border-top pt-3">
                            <h4 class="mb-3"><strong>Categories</strong></h4>
                            <ul class="row list-unstyled">
                                <?php
                                    $names = explode(", ", $product->subcategory_names);
                                    foreach($names as $name) {
                                        echo "<li class='col-md-1 px-0 me-3'><strong class='bg-light shadow-sm px-2'>" . $name . "</strong></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">

                <div class="col-md-12">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Description</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Reviews</button>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane pt-5 p-3 fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h4><strong>Product description</strong></h4>
                            <p><?php echo $product->description; ?></p>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            @if(session()->has('customer_id'))
                                <single-product-review retailerid="{{ $retailer->id }}" productid="{{ $product->id }}" :user="true" isreviewed="{{ $isReviewed }}"></single-product-review>
                            @else
                                <single-product-review retailerid="{{ $retailer->id }}" :user="false" productid="{{ $product->id }}" isreviewed="{{ $isReviewed }}"></single-product-review>
                            @endif

                            {{-- <div class="row mt-5">
                                @if($reviews->count() > 0)
                                    @foreach($reviews as $review)
                                        @php
                                            $customer = App\Models\User::where('id', $review->customer_id)->select('name', 'profile')->first();
                                        @endphp
                                        <div class="col-md-6">
                                            <div class="card p-3 mb-4">
                                                <div class="row">
                                                    <div class="col-2">
                                                        @if($customer->profile == '')
                                                        <img src="{{ asset('dummy.png') }}" class="img-thumbnail" style="height: 80px;width: 80px;">
                                                        @else
                                                            <img src="{{ $customer->profile }}" class="img-thumbnail" style="height: 80px;width: 80px;">
                                                        @endif
                                                    </div>
                                                    <div class="col-10">
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
                            </div> --}}
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

@endsection
