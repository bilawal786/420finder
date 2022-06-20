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
    <section class="fiveCols mt-5">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h5 style="font-weight: 600;" class="pb-2">Dispensaries</h5>
                    @if(!empty($location))
                    <p>Showing Marijuana Listings in <strong>{{ $location }}</strong></p>
                    @else
                        <div class="col-md-4 offset-md-4 py-3 mb-4 border text-black-50 text-center">
                            Please select your location.
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                @if(count($dispensaries) > 0)
                    @foreach($dispensaries as $dispensary)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3" style="margin-bottom: 30px">
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
                    </div>
                    @endforeach
                @else
                    <div class="col-md-4 offset-md-4 shadow p-5 text-center">
                        <img src="{{ asset('images/not-found.svg') }}" alt="">
                        <h3 class="pt-3" style="font-weight: bold;">No Dispensaries in your area.</h3>
                        <p class="text-black-50 pt-2">Would you like to look for a dispensary service near you or try a different address?</p>
                    </div>
                @endif
            </div>

            @if(count($dispensaries) > 0)
            <div class="paginate-links">
                {{ $dispensaries->links() }}
            </div>
            @endif

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

