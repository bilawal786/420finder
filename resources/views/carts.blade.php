@extends('layouts.app')

    @section('Cart', '420 Finder')

    @section('content')

    <section class="mt-5" style="padding-top: 0 !important">
        <div class="container mt-4">
          <div class="row pb-5">
            @if($deliverycart->count() == 0 && $dispensarycart->count() == 0 &&$dealsClaimed->count() == 0)
              <div class="col-md-4 offset-md-4 text-center">
                  <div class="cartEmpty mb-3">
                    <i class="far fa-question-circle"></i>
                  </div>
                  <h3>Your Cart Is Empty.</h3>
                  <p class="text-black-50">Don't wait to bake. Add items to your cart and enjoy your weed today.</p>
              </div>
            @endif

            @if($deliverycart->count() > 0)

              <div class="row content-row">
                    <div class="col-12 col-md-6">
                        <div class="row topDeliveryRow retailer-cart-info">
                            <div class="col-md-4 text-center col-4 mb-4">
                                @if($business->profile_picture == '')
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="" class="w-100 h-100 img-thumbnail">
                                @else
                                    <img src="{{ $business->profile_picture }}" alt="" class="w-100 h-100 img-thumbnail">
                                @endif
                            </div>
                            <div class="col-md-8 col-8">
                                <h3 class="retailerbnametext text-black-50"><strong>{{ $business->business_name }}</strong></h3>
                                <?php
                                    $reviews = App\Models\RetailerReview::where('retailer_id', $business->id)->whereNull('product_id')->get();
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


                                        // echo " <span class='reviewCount'>(".$reviews->count().")</span>";

                                    ?>

                                        <div class="rating-wrap rating-wrap-cart">
                                            <div class="retailer-rating" data-rating="{{ $totalratings }}"></div>
                                            <div class="reviewAvgCount">
                                                <span>{{ number_format($totalratings, 1) }}</span>
                                                <span>({{ count($reviews) }})</span>
                                            </div>
                                        </div>
                                </ul>
                                <p class="retailerbnametext">{{ $business->city }}, {{ $business->state_province }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-md-6 retailer-contact-info">
                        <div class="row detailedBox">
                            <div class="col-md-6 col-6">
                                <ul class="list-unstyled">
                                    <li class="pb-2"><i class="fas fa-car"></i> Delivery only</li>
                                    <li class="pb-2"><i class="fas fa-id-card"></i> {{ $business->business_type }}</li>
                                    <li class="pb-2"><i class="fas fa-shopping-cart"></i> Order online (delivery)</li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-6">
                                <ul class="list-unstyled">
                                    <li class="pb-2"><i class="fas fa-clock"></i>
                                        <?php
                                            if ($business->opening_time >= date('h:i') OR $business->closing_time <= date('h:i')) {
                                                echo "<span style='color: #00b700;font-weight: bold'> OPEN </span>";
                                            } else {
                                                echo "<span style='color: rgb(227, 69, 42);font-weight: bold; margin-right: 0.2rem;'> CLOSED </span> Opens " . $business->opening_time;
                                            }
                                        ?>
                                    </li>
                                    {{-- <li class="pb-2">
                                        <i class="fas fa-check-circle"></i> License Information
                                    </li> --}}
                                    <li class="pb-2"><a href="{{ $business->instagram }}" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex retailer-contact-btn">
                                <a href="tel:{{ $business->phone_number }}" class="btn-cta">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>{{ $business->phone_number }}</span>
                                </a>
                                <a href="mailto:{{ $business->email }}" class="btn-cta" target="_blank">
                                    <i class="fas fa-directions"></i>
                                    <span>Email the retailer</span>
                                </a>
                                <div class="favBrand favoriteButton">
                                    @if (Session::has('customer_id') == false)
                                        <a href="{{ route('signin') }}"><i class="far fa-heart pe-4 shadow ms-3"></i></a>
                                    @else
                                        <a rel="{{ $business->id }}" class="favdelivery cursor-pointer"><i class="far fa-heart pe-4 shadow ms-3"></i></a>
                                    @endif
                                    <span class="followers"> 309 followers</span>
                                </div>
                            </div>
                        </div>

                    </div>
              </div>

              <div class="row">

                <div class="col-md-12">

                  <h4 class="mb-4"><strong>Your delivery order</strong></h4>

                </div>

                <div class="col-12 col-md-4">

                  @foreach($deliverycart as $item)

                    <div class="card p-3 mb-2">

                      <div class="row">

                        <div class="col-md-8">

                          <div class="row">

                            <div class="col-3">

                              <img src="{{ $item->image }}" class="w-100 img-thumbnail">

                            </div>

                            <div class="col-9">
                              <p><strong>{{ $item->name }}</strong></p>
                              <p class="mt-4" style="font-size: 18px;"><strong>${{ $item->price }}</strong></p>
                            </div>

                          </div>

                        </div>

                        <div class="col-md-4 text-end">

                          <a href="{{ route('deletedeliverycartitem', ['id' => $item->cartid]) }}" onclick="return confirm('Are you sure you want to remove this item?');" class="btn border text-black-50 shadow-sm"><i class="fa fa-trash"></i></a>

                        </div>

                      </div>

                    </div>

                  @endforeach

                </div>

                <div class="col-12 col-md-8">

                  <div class="card p-3">

                    <p class="border-bottom pb-2"><strong>Subtotal ( {{ $deliverycart->count() }} item ) </strong></p>

                    <ul class="list-unstyled">
                      <?php $sum = 0; ?>
                      @foreach($deliverycart as $index => $side)
                        <li class="pb-3">
                          <div class="row">
                            <div class="col-md-9">
                              <strong>{{ $index + 1 }}. </strong>
                              <img src="{{ $side->image }}" class="img-thumbnail" style="width: 30px;height: 30px;">
                              {{ substr($side->name, 0, 20) }}...
                            </div>
                            <div class="col-md-3">
                              <span>&nbsp;&nbsp;&nbsp;&nbsp;${{ $side->price }}</span>
                            </div>
                          </div>
                        </li>
                        <?php $sum = $sum + $side->price; ?>
                      @endforeach
                    </ul>

                    <div class="row border-top pt-3">

                      <div class="col-md-6">

                        <p>
                          <strong>Order Total</strong>
                        </p>

                      </div>

                      <div class="col-md-6 text-end">
                        <p><strong>${{ $sum }}</strong></p>
                      </div>

                    </div>

                  </div>

                  <div class="card p-3 mt-3">

                    <form action="{{ route('stripe.post') }}" method="post" id="paymentForm" class="delivery-cart-form">
                        @csrf

                        <div class="form-group pb-2">
                          <label for=""><strong>Name on Order</strong></label>
                          <input type="text" name="nameonorder" placeholder="Enter Name" class="form-control" required="">
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>Phone Number</strong></label>
                          <input type="number" name="phone_number" placeholder="Enter Phone Number" class="form-control" required="">
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>Name on ID</strong></label>
                          <input type="text" name="nameonid" placeholder="Enter Name on ID" class="form-control" required="">
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>ID Type</strong></label>
                          <select name="id_type" id="" class="form-control" required="">
                            <option value="">Select ID Type</option>
                            <option value="Driver License">Driver License</option>
                            <option value="Passport">Passport</option>
                            <option value="ID Card">ID Card</option>
                            <option value="Military ID">Military ID</option>
                          </select>
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>ID Number</strong></label>
                          <input type="number" name="id_number" placeholder="Enter ID Number" class="form-control" required="">
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>Delivery Address</strong></label>
                          <input type="text" name="delivery_address" placeholder="Enter Delivery Address" class="form-control" required="">
                        </div>

                        <div class="row pb-2">
                          <div class="col-4">
                            <div class="form-group">
                              <label for=""><strong>City</strong></label>
                              <input type="text" name="city" class="form-control" required="">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <label for=""><strong>State</strong></label>
                              <input type="text" name="state" class="form-control" required="">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <label for=""><strong>Zip Code</strong></label>
                              <input type="number" name="zip_code" class="form-control" required="">
                            </div>
                          </div>
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>Additional Delivery Notes:</strong></label>
                          <textarea name="additional_notes" placeholder="Enter Additional Delivery Notes..." cols="5" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="row">
                           <div class="col-xs-12">
                              <button class="btn appointment-btn m-0 w-100 delivery-cart-submit" type="submit" id="payButton">Place Order</button>
                           </div>
                        </div>

                    </form>

                  </div>

                </div>

              </div>

            @endif

            @if($dispensarycart->count() > 0)

              <div class="row">

                <div class="col-md-12">

                  <div class="row">

                    <div class="col-md-6">
                      <h4 class="mb-4"><strong>Your pickup order</strong></h4>
                    </div>

                    <div class="col-md-6">

                    </div>

                  </div>

                </div>

                <div class="col-md-8">

                  @foreach($dispensarycart as $item)

                    <div class="card p-3 mb-2">

                      <div class="row">

                        <div class="col-md-8">

                          <div class="row">

                            <div class="col-3">

                              <img src="{{ $item->image }}" class="w-100 img-thumbnail">

                            </div>

                            <div class="col-9">
                              <p><strong>{{ $item->name }}</strong></p>
                              <p class="mt-4" style="font-size: 18px;"><strong>${{ $item->price }}</strong></p>
                            </div>

                          </div>

                        </div>

                        <div class="col-md-4 text-end">

                          <a href="{{ route('deletedeliverycartitem', ['id' => $item->cartid]) }}" onclick="return confirm('Are you sure you want to remove this item?');" class="btn border text-black-50 shadow-sm"><i class="fa fa-trash"></i></a>

                        </div>

                      </div>

                    </div>

                  @endforeach

                </div>

                <div class="col-md-4">

                  <div class="card p-3">

                    <p class="border-bottom pb-2"><strong>Subtotal ( {{ $dispensarycart->count() }} item ) </strong></p>

                    <ul class="list-unstyled">
                      <?php $sum = 0; ?>
                      @foreach($dispensarycart as $index => $side)
                        <li class="pb-3">
                          <div class="row">
                            <div class="col-md-9">
                              <strong>{{ $index + 1 }}. </strong>
                              <img src="{{ $side->image }}" class="img-thumbnail" style="width: 30px;height: 30px;">
                              {{ substr($side->name, 0, 20) }}...
                            </div>
                            <div class="col-md-3">
                              <span>&nbsp;&nbsp;&nbsp;&nbsp;${{ $side->price }}</span>
                            </div>
                          </div>
                        </li>
                        <?php $sum = $sum + $side->price; ?>
                      @endforeach
                    </ul>

                    <div class="row border-top pt-3">

                      <div class="col-md-6">

                        <p>
                          <strong>Order Total</strong>
                        </p>

                      </div>

                      <div class="col-md-6 text-end">
                        <p><strong>${{ $sum }}</strong></p>
                      </div>

                    </div>

                  </div>

                  <div class="card p-3 mt-3">

                    <form action="{{ route('stripe.post') }}" method="post">
                        @csrf

                        <div class="form-group pb-2">
                          <label for=""><strong>Name on Order</strong></label>
                          <input type="text" name="nameonorder" placeholder="Enter Name" class="form-control" required="">
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>Phone Number</strong></label>
                          <input type="text" name="phone_number" placeholder="Enter Phone Number" class="form-control" required="">
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>Name on ID</strong></label>
                          <input type="text" name="nameonid" placeholder="Enter Name on ID" class="form-control" required="">
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>ID Type</strong></label>
                          <select name="id_type" id="" class="form-control" required="">
                            <option value="">Select ID Type</option>
                            <option value="Driver License">Driver License</option>
                            <option value="Passport">Passport</option>
                            <option value="ID Card">ID Card</option>
                            <option value="Military ID">Military ID</option>
                          </select>
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>ID Number</strong></label>
                          <input type="text" name="id_number" placeholder="Enter ID Number" class="form-control" required="">
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>Delivery Address</strong></label>
                          <input type="text" name="delivery_address" placeholder="Enter Delivery Address" class="form-control" required="">
                        </div>

                        <div class="row pb-2">
                          <div class="col-4">
                            <div class="form-group">
                              <label for=""><strong>City</strong></label>
                              <input type="text" name="city" class="form-control" required="">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <label for=""><strong>State</strong></label>
                              <input type="text" name="state" class="form-control" required="">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <label for=""><strong>Zip Code</strong></label>
                              <input type="text" name="zip_code" class="form-control" required="">
                            </div>
                          </div>
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>Additional Delivery Notes:</strong></label>
                          <textarea name="additional_notes" placeholder="Enter Additional Delivery Notes..." cols="5" rows="5" class="form-control" required=""></textarea>
                        </div>

                        <div class="row">
                           <div class="col-xs-12">
                              <button class="btn appointment-btn m-0 w-100" type="submit">Place Order</button>
                           </div>
                        </div>

                    </form>

                  </div>

                </div>

              </div>

            @endif


            @if($dealsClaimed->count() > 0)
            <div class="row">

                <div class="col-md-12">

                  <div class="row">

                    <div class="col-md-6">
                      <h4 class="mb-4"><strong>Your pickup order</strong></h4>
                    </div>

                    <div class="col-md-6">

                    </div>

                  </div>

                </div>

                <div class="col-md-8">

                  @foreach($dealsClaimed as $deal)

                    <div class="card p-3 mb-2">

                      <div class="row">

                        <div class="col-md-8">

                          <div class="row">

                            <div class="col-3">

                              <img src="{{ json_decode($deal->picture)[0] }}" class="w-100 img-thumbnail">

                            </div>

                            <div class="col-9">
                              <p><strong>{{ $deal->title }}</strong></p>
                              <p class="mt-4" style="font-size: 18px;"><strong>${{ $deal->deal_price }}</strong></p>
                            </div>

                          </div>

                        </div>

                        <div class="col-md-4 text-end">

                            <a href="{{ route('deletedealsClaimed', ['id' => $deal->id]) }}" onclick="return confirm('Are you sure you want to remove this deal?');" class="btn border text-black-50 shadow-sm"><i class="fa fa-trash"></i></a>

                        </div>

                      </div>

                    </div>

                  @endforeach

                </div>

                <div class="col-md-4">

                  <div class="card p-3">

                    <p class="border-bottom pb-2"><strong>Subtotal ( {{ $dealsClaimed->count() }} item ) </strong></p>

                    <ul class="list-unstyled">
                      <?php $sum = 0; ?>
                      @foreach($dealsClaimed as $side)
                        <li class="pb-3">
                          <div class="row">
                            <div class="col-md-9">
                              <strong>{{ $loop->iteration }}. </strong>
                              <img src="{{ json_decode($side->picture)[0] }}" class="img-thumbnail" style="width: 30px;height: 30px;">
                              {{ substr($side->title, 0, 20) }}...
                            </div>
                            <div class="col-md-3">
                              <span>&nbsp;&nbsp;&nbsp;&nbsp;${{ $side->deal_price }}</span>
                            </div>
                          </div>
                        </li>
                        <?php $sum = $sum + (int) $side->deal_price; ?>
                      @endforeach
                    </ul>

                    <div class="row border-top pt-3">

                      <div class="col-md-6">

                        <p>
                          <strong>Order Total</strong>
                        </p>

                      </div>

                      <div class="col-md-6 text-end">
                        <p><strong>${{ $sum }}</strong></p>
                      </div>

                    </div>

                  </div>

                  <div class="card p-3 mt-3">

                    <form action="{{ route('dealPurchased') }}" method="post">
                        @csrf

                        <div class="form-group pb-2">
                          <label for=""><strong>Name on Order</strong></label>
                          <input type="text" name="nameonorder" placeholder="Enter Name" class="form-control" required="">
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>Phone Number</strong></label>
                          <input type="number" name="phone_number" placeholder="Enter Phone Number" class="form-control" required="">
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>Name on ID</strong></label>
                          <input type="text" name="nameonid" placeholder="Enter Name on ID" class="form-control" required="">
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>ID Type</strong></label>
                          <select name="id_type" id="" class="form-control" required="">
                            <option value="">Select ID Type</option>
                            <option value="Driver License">Driver License</option>
                            <option value="Passport">Passport</option>
                            <option value="ID Card">ID Card</option>
                            <option value="Military ID">Military ID</option>
                          </select>
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>ID Number</strong></label>
                          <input type="number" name="id_number" placeholder="Enter ID Number" class="form-control" required="">
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>Delivery Address</strong></label>
                          <input type="text" name="delivery_address" placeholder="Enter Delivery Address" class="form-control" required="">
                        </div>

                        <div class="row pb-2">
                          <div class="col-4">
                            <div class="form-group">
                              <label for=""><strong>City</strong></label>
                              <input type="text" name="city" class="form-control" required="">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <label for=""><strong>State</strong></label>
                              <input type="text" name="state" class="form-control" required="">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <label for=""><strong>Zip Code</strong></label>
                              <input type="number" name="zip_code" class="form-control" required="">
                            </div>
                          </div>
                        </div>

                        <div class="form-group pb-2">
                          <label for=""><strong>Additional Delivery Notes:</strong></label>
                          <textarea name="additional_notes" placeholder="Enter Additional Delivery Notes..." cols="5" rows="5" class="form-control" required=""></textarea>
                        </div>

                        <div class="row">
                           <div class="col-xs-12">
                              <button class="btn appointment-btn m-0 w-100" type="submit" >Place Order</button>
                           </div>
                        </div>

                    </form>

                  </div>

                </div>

              </div>

            @endif

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

        $(function() {
            $(".delivery-cart-form").submit(function () {
                $(".delivery-cart-submit").attr("disabled", true);
                return true;
            });
        });

        $(".retailer-rating").starRating({
            readOnly: true,
            totalStars: 5,
            starSize: 18,
            emptyColor: 'lightgray',
            activeColor: '#f8971c',
            useGradient: false
        });

    </script>
@endpush

