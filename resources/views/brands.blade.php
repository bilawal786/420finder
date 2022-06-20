@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="mt-5 pt-5">

        <div class="container mt-4">

            <div class="row">

                <div class="col-md-12">

                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

                        <div class="carousel-indicators">

                            @if(count($brands) > 0)

                                @foreach($brands as $index => $single)

                                    @if($index < 5)

                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}" class="@if($index == 0) active @endif" @if($index == 0) aria-current="true" @endif aria-label="Slide {{ $index }}"></button>

                                    @endif

                                @endforeach

                            @endif

                        </div>

                        <div class="carousel-inner">

                            @if(count($brands) > 0)

                                @foreach($brands as $index => $brand)

                                    @if($index < 5)

                                        <div class="carousel-item @if($index == 0) active @endif">
                                            <img src="{{ $brand->cover }}" class="d-block w-100 br-30" alt="...">
                                        </div>

                                    @endif

                                @endforeach

                            @endif

                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">

                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>

                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">

                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>

                        </button>

                    </div>

                </div>

            </div>

            <div class="row py-5">

                <div class="col-md-12 text-center">
                    
                    <h1><strong>420 FINDER BRANDS</strong> | LEARN, TRY, & REVIEW.</h1>

                </div>

            </div>

            <div class="row">
                @if(!empty($location))
                <p>Showing Marijuana Listings in <strong>{{ $location }}</strong></p>
                @else
                    <div class="col-md-4 offset-md-4 py-3 mb-4 border text-black-50 text-center">
                        Please select your location.
                    </div>
                @endif
                @if(count($brands) > 0)
                    @foreach($brands as $brand)
                        <a href="{{ route('brandsingle', ['slug' => $brand->slug, 'id' => $brand->id]) }}" class="col-md-2 col-6">
                            <div class="border brandvisited">
                                <img src="{{ $brand->logo }}" alt="{{ $brand->name }}" class="w-100">
                                <div class="pt-1 px-3 border-top">
                                    <p class="pt-2 mb-0"><strong>{{ $brand->name }}</strong></p>
                                    <p class="text-black-50">4,231 followers</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                <div class="col-md-4 offset-md-4 shadow p-5 text-center">
                    <img src="{{ asset('images/not-found.svg') }}" alt="">
                    <h3 class="pt-3" style="font-weight: bold;">No Brands in your area.</h3>
                    <p class="text-black-50 pt-2">Would you like to look for a brand service near you or try a different address?</p>
                </div>
                @endif
            </div>

        </div>

    </section>

@endsection
