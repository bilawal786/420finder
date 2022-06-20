
<header id="header" class="fixed-top {{ request()->routeIs('desktop-map') ? 'map-page' : '' }}">

    {{-- DESKTOP NAV --}}
    <div class="container desktop-nav-container">

        <div class="row">
            <div class="col-8">

                <div class="row">
                    <div class="col-2">
                        <div class="site-logo">
                            <a href="{{ route('index') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid" ></a>
                        </div>
                    </div>

                    <div class="col-10">
                        <div class="topMenuSearchBar">
                            <form action="{{ route('search') }}" method="GET">

                                <div class="row product-location-wrap">

                                            {{-- <div class="col-6 d-flex align-items-center search-product-wrap px-0">
                                                <span class="searchIcon">
                                                    <i class="fas fa-search"></i>
                                                </span>

                                                <div class="search-product">
                                                    <input type="text" name="keyword" placeholder="Products, retailers, brands, and more">
                                                </div>

                                            </div> --}}

                                            <?php
                                            if(!request()->routeIs('maps')) {
                                            ?>
                                           <product-component></product-component>
                                            <?php }
                                            ?>

                                            {{-- <div class="col-6 px-0">
                                                <div id="currentLocation" class="d-flex location-wrap">

                                                    <span id="getcurrentlocation" class="btn btn-sm location-icon" onclick="getLocation()"><i class="fas fa-map-marker-alt"></i></span>

                                                    <span id="locationBox" class="locationBox">
                                                        <input type="text" id="search_input" class="search_input" value="Los Angeles, California, USA" placeholder="Type address..." />
                                                        <input type="hidden" id="loc_lat" />
                                                        <input type="hidden" id="loc_long" />
                                                    </span>
                                                </div>
                                            </div> --}}

                                           <desktop-location-search>
                                           </desktop-location-search>

                                    </div>

                            </form>

                            {{-- MENU LINKS --}}
                            <div class="menu-links">
                                <ul class="list-unstyled d-flex subMenu pt-2 subMenuRow">

                                    <li>
                                        <a href="{{ route('dispensaries') }}">
                                            Dispensaries</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('deliveries') }}">Deliveries</a>
                                    </li>

                                    {{-- <li>
                                        <a href="{{ route('maps') }}">Maps</a>
                                    </li> --}}

                                    <li>
                                        <a href="{{ route('desktop-map') }}">Maps</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('brands') }}">Brands</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('products.index') }}">
                                            Products</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('deals') }}">Deals</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('strains') }}">Strains</a>
                                    </li>

                                </ul>

                            </div>
                            {{-- MENU LINKS ENDS --}}

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-4 d-flex">

                <ul class="d-flex justify-content-end align-items-center" style="margin-left: auto; list-style: none">
                    <ul class="mobileIconsRow">

                        <ul class="d-flex justify-content-center">

                            <li class="mobileIconsList desktop-li" style="border-bottom: none;">
                                <a class="nav-link" href="{{ route('notifications') }}">
                                    <i class="fas fa-bell"></i>
                                    <span class="notification">{{ $notifications->count() }}</span>
                                </a>
                            </li>

                            <li class="mobileIconsList desktop-li" style="border-bottom: none;">
                                <a class="nav-link" href="{{ route('favorites') }}">
                                    <i class="fas fa-heart"></i>
                                    <span class="notification">
                                        <?php
                                            $checkfavs = App\Models\Favorite::where('customer_id', session('customer_id'))->count();
                                            echo $checkfavs;
                                        ?>
                                    </span>
                                </a>
                            </li>

                            <li class="mobileIconsList desktop-li" style="border-bottom: none;">
                                <a class="nav-link" href="{{ route('cart') }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="notification cart-count">
                                        <?php

                                       if(Session::has('customer_id')) {

                                        $customerId = Session::get('customer_id');
                                        $checkDeliveryCart = App\Models\DeliveryCart::where('customer_id', $customerId)->count();
                                        $checkDispenseryCart = App\Models\DispensaryCart::where('customer_id', $customerId)->count();
                                        $sum = $checkDeliveryCart + $checkDispenseryCart;
                                        echo $sum;
                                        } else {
                                           echo 0;
                                        }
                                        ?>
                                    </span>
                                </a>
                            </li>

                            @if (Session::has('customer_id') == false && Session::has('business_id') == false)
                            <li style="list-style: none"><a class="nav-link"
                                style="background: #f8971c;
                                color: #fff;
                                border-radius: 20px;
                                padding: 0.3rem 0.7rem;
                                font-size: 0.9rem;"
                                href="{{ route('signin') }}">Sign in</a></li>
                            @endif

                        </ul>

                        <li class="mobileIconsList hambergerSubMenuItems">
                            <a class="nav-link" href="{{ route('dispensaries') }}">Dispensaries</a>
                        </li>

                        <li class="mobileIconsList hambergerSubMenuItems">
                            <a class="nav-link" href="{{ route('deliveries') }}">Deliveries</a>
                        </li>

                        <li class="mobileIconsList hambergerSubMenuItems">
                            <a href="{{ route('desktop-map') }}">Maps</a>
                        </li>

                        <li class="mobileIconsList hambergerSubMenuItems">
                            <a class="nav-link" href="{{ route('brands') }}">Brands</a>
                        </li>

                        <li class="mobileIconsList hambergerSubMenuItems">
                            <a class="nav-link" href="{{ route('deals') }}">Deals</a>
                        </li>

                        <li class="mobileIconsList hambergerSubMenuItems">
                            <a class="nav-link" href="{{ route('strains') }}">Strains</a>
                        </li>
                    </ul>

                    @if(Session::has('business_id') == true)
                    <li class="dropdown userAuthDropdown customer-dropdown"><a href="{{ route('businessprofile') }}"><span><i class="fas fa-user-circle" style="font-size: 25px;"></i></span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                          <li><a href="{{ route('businessprofile') }}">Dashboard</a></li>
                          <li><a href="{{ route('businessaccountsettings') }}">Account Settings</a></li>
                          <li><a href="{{ route('managecustomeraccount') }}">Back to Customer Account</a></li>
                          <hr>
                          <li><a href="{{ route('businesslogout') }}" onclick="return confirm('Are you sure you want to logout?');">Logout</a></li>
                        </ul>
                    </li>
                  @else

                    @if (Session::has('customer_id') == false)
                          <li class="mobileIconsList hambergerSubMenuItems"><a class="nav-link" href="{{ route('signin') }}">Sign in</a></li>
                    @else
                        <li class="dropdown userAuthDropdown customer-dropdown"><a href="{{ route('profile') }}"><span><i class="fas fa-user-circle" style="font-size: 25px;"></i></span> <i class="bi bi-chevron-down"></i></a>

                            <ul>
                              <li><a href="{{ route('profile') }}">View Account</a></li>
                              <li><a href="{{ route('accountsettings') }}">Account Settings</a></li>
                              <li><a href="{{ route('favorites') }}">Favorits</a></li>
                              <li><a href="{{ route('recentlyviewed') }}">Recently Viewed</a></li>
                              <li><a href="{{ route('managemybusiness') }}">Manage My Business</a></li>
                              <hr>
                              <li><a href="{{ route('logout') }}" onclick="return confirm('Are you sure you want to logout?');">Logout</a></li>
                            </ul>
                        </li>
                    @endif

                @endif

                    </ul>


            </div>
        </div>
    </div>

    {{-- MOBILE NAV --}}
    <div class="container mobile-nav-container">
        <div class="logo-icons-wrap d-flex align-items-center row">
            <div class="col-4">
                <div class="menu-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24"><path fill="#252935" fill-rule="evenodd" clip-rule="evenodd" d="M4 8a1 1 0 0 1 0-2h16a1 1 0 1 1 0 2H4Zm0 5a1 1 0 1 1 0-2h16a1 1 0 1 1 0 2H4Zm-1 4a1 1 0 0 0 1 1h16a1 1 0 1 0 0-2H4a1 1 0 0 0-1 1Z"></path></svg>
                </div>
            </div>

            <div class="col-4">
                <div class="menu-logo mobile-logo">
                    <div class="site-logo">
                        <a href="{{ route('index') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid" width="100px" height="100px"></a>
                    </div>
                </div>
            </div>

            <div class="col-4 notify-icons">
                <ul class="d-flex justify-content-end">

                    <li class="mobileIconsList desktop-li" style="border-bottom: none;">
                        <a class="nav-link" href="{{ route('notifications') }}">
                            <i class="fas fa-bell"></i>
                            <span class="notification">{{ $notifications->count() }}</span>
                        </a>
                    </li>

                    <li class="mobileIconsList desktop-li" style="border-bottom: none;">
                        <a class="nav-link" href="{{ route('favorites') }}">
                            <i class="fas fa-heart"></i>
                            <span class="notification">
                                <?php
                                    $checkfavs = App\Models\Favorite::where('customer_id', session('customer_id'))->count();
                                    echo $checkfavs;
                                ?>
                            </span>
                        </a>
                    </li>

                    <li class="mobileIconsList desktop-li" style="border-bottom: none;">
                        <a class="nav-link" href="{{ route('cart') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="notification cart-count">
                                <?php

                                   if(Session::has('customer_id')) {

                                      $customerId = Session::get('customer_id');
                                      $checkDeliveryCart = App\Models\DeliveryCart::where('customer_id', $customerId)->count();
                                      $checkDispenseryCart = App\Models\DispensaryCart::where('customer_id', $customerId)->count();
                                      $sum = $checkDeliveryCart + $checkDispenseryCart;
                                      echo $sum;
                                    } else {
                                        echo 0;
                                    }
                                ?>
                            </span>
                        </a>
                    </li>

                </ul>


            </div>

            {{-- <div class="mobile-nav">
                <ul class="mobileIconsRow">

                    <li class="mobileIconsList hambergerSubMenuItems">
                        <a class="nav-link" href="{{ route('dispensaries') }}">Dispensaries</a>
                    </li>

                    <li class="mobileIconsList hambergerSubMenuItems">
                        <a class="nav-link" href="{{ route('deliveries') }}">Deliveries</a>
                    </li>

                    <li class="mobileIconsList hambergerSubMenuItems">
                        <a class="nav-link" href="{{ route('maps') }}">Maps</a>
                    </li>

                    <li class="mobileIconsList hambergerSubMenuItems">
                        <a class="nav-link" href="{{ route('brands') }}">Brands</a>
                    </li>

                    <li class="mobileIconsList hambergerSubMenuItems">
                        <a class="nav-link" href="{{ route('deals') }}">Deals</a>
                    </li>

                    <li class="mobileIconsList hambergerSubMenuItems">
                        <a class="nav-link" href="{{ route('strains') }}">Strains</a>
                    </li>

                    @if(Session::has('business_id') == true)
                        <li class="dropdown userAuthDropdown"><a href="{{ route('businessprofile') }}"><span><i class="fas fa-user-circle" style="font-size: 25px;"></i></span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                              <li><a href="{{ route('businessprofile') }}">Dashboard</a></li>
                              <li><a href="{{ route('businessaccountsettings') }}">Account Settings</a></li>
                              <li><a href="{{ route('managecustomeraccount') }}">Back to Customer Account</a></li>
                              <hr>
                              <li><a href="{{ route('businesslogout') }}" onclick="return confirm('Are you sure you want to logout?');">Logout</a></li>
                            </ul>
                        </li>
                    @else

                        @if (Session::has('customer_id') == false)
                                <li class="mobileIconsList hambergerSubMenuItems"><a class="nav-link" href="{{ route('signin') }}">Sign in</a></li>
                        @else
                            <li class="dropdown userAuthDropdown"><a href="{{ route('profile') }}"><span><i class="fas fa-user-circle" style="font-size: 25px;"></i></span> <i class="bi bi-chevron-down"></i></a>

                                <ul>
                                  <li><a href="{{ route('profile') }}">View Account</a></li>
                                  <li><a href="{{ route('accountsettings') }}">Account Settings</a></li>
                                  <li><a href="{{ route('favorites') }}">Favorits</a></li>
                                  <li><a href="{{ route('recentlyviewed') }}">Recently Viewed</a></li>
                                  <li><a href="{{ route('managemybusiness') }}">Manage My Business</a></li>
                                  <hr>
                                  <li><a href="{{ route('logout') }}" onclick="return confirm('Are you sure you want to logout?');">Logout</a></li>
                                </ul>
                            </li>
                        @endif

                    @endif

                </ul>
            </div> --}}

        </div>

        <div class="container">
            <div class="menu-search-bar">
                <form action="{{ route('search') }}" method="GET">

                    <div class="row product-location-wrap">

                                <div class="col-6 d-flex align-items-center search-product-wrap px-0">
                                    <span class="searchIcon">
                                        <i class="fas fa-search"></i>
                                    </span>

                                    <div class="search-product">
                                        <input type="text" name="keyword" placeholder="Products, retailers, brands, and more" class="mobile-search-product-input">
                                    </div>
                                </div>

                                <div class="col-6 px-0">
                                    <div id="mobileCurrentLocation" class="d-flex location-wrap">

                                        <span id="getcurrentlocation" class="btn btn-sm location-icon" onclick="getLocation()"><i class="fas fa-map-marker-alt"></i></span>

                                        {{-- <span id="mobileLocationBox" class="locationBox"> --}}
                                            <span class="locationBox mobileInput">
                                            {{-- <input type="text" id="mobile_search_input" value="Los Angeles, California, USA" placeholder="Type address..." class="mobile-search-location-input"/> --}}
                                            <input type="text" value="Los Angeles, California, USA" placeholder="Type address..." class="mobile-search-location-input"/>
                                            {{-- <input type="hidden" id="mobile_loc_lat" />
                                            <input type="hidden" id="mobile_loc_long" /> --}}
                                        </span>
                                    </div>
                                </div>

                        </div>
                </form>
            </div>
        </div>


    </div>

    {{-- MOBILE SEARCH MENU --}}
    <div class="search-menu">
        {{-- <div class="container">
            <div class="row search-logo-wrap">
                <div class="col-4 close-btn">
                    <div class="close-btn">
                        <h6 class="close-btn-text">Cancel</h6>
                    </div>
                </div>
                <div class="col-4">
                    <div class="logo-btn">
                        <img src="{{ asset("assets/img/logo.png") }}" alt="Search Menu Logo">
                    </div>
                </div>
                <div class="col-4">
                    <div class="search-btn">
                        <h6>Search</h6>
                    </div>
                </div>
            </div>

            <div class="form-wrap search-menu-form">
                <form action="">
                    <div class="product-search">
                        <input type="text" name="" placeholder="Products, retailors, brands and more" class="search-menu-form-input">
                    </div>
                </form>

                <form action="">
                    <div class="location-search" id="mobileLocationBox">
                        <input type="text" name="" placeholder="Los Angeles, CA" class="search-menu-form-input" id="mobile_search_input">
                        <input type="hidden" id="mobile_loc_lat" />
                        <input type="hidden" id="mobile_loc_long" />
                    </div>
                </form>
            </div>

            <div class="current-location-btn d-flex align-items-center">
                <div class="current-location-icon">
                    <svg class="wm-locate" width="20px" height="20px" viewBox="0 0 20 20"><path d="M10 6.364C7.99 6.364 6.364 7.99 6.364 10c0 2.01 1.627 3.636 3.636 3.636 2.01 0 3.636-1.627 3.636-3.636 0-2.01-1.627-3.636-3.636-3.636zm8.127 2.727C17.71 5.3 14.7 2.29 10.91 1.874V0H9.09v1.873C5.3 2.29 2.29 5.3 1.874 9.09H0v1.82h1.873c.418 3.79 3.427 6.8 7.218 7.217V20h1.82v-1.873c3.79-.418 6.8-3.427 7.217-7.218H20V9.09h-1.873zM10 16.365c-3.518 0-6.364-2.846-6.364-6.364S6.482 3.636 10 3.636 16.364 6.482 16.364 10 13.518 16.364 10 16.364z" fill="#999999"></path></svg>
                </div>
                <div class="current-location-text">
                    <h6>Current Location</h6>
                </div>
            </div>
        </div> --}}
        <mobilesearch-component logo="{{ asset("assets/img/logo.png") }}"></mobilesearch-component>
    </div>

    {{-- MOBILE SIDE MENU --}}
    <div class="side-menu">
        <div class="side-menu-backdrop"></div>
        <div class="side-menu-content">

            @if(Session::has('business_id') == true || Session::has('customer_id') == true)
            @else
            <div class="side-menu-btns">
              <a href="{{ route('signin') }}">
                SIGN IN
              </a>
              <a href="{{ route('signup') }}">
                SIGN UP
              </a>
            </div>
           @endif

            <ul>
                <li>
                    <a href="{{ route('dispensaries') }}">
                        <i class="bi bi-shop"></i>
                        Dispensaries
                    </a>
                </li>

                <li>
                    <a href="{{ route('deliveries') }}">
                        <i class="bi bi-truck"></i>
                        Deliveries</a>
                </li>

                <li>
                    <a href="{{ route('desktop-map') }}">
                        <i class="bi bi-map"></i>
                        Maps</a>
                </li>

                <li>
                    <a href="{{ route('brands') }}">
                        <i class="bi bi-check-circle"></i>
                        Brands</a>
                </li>

                <li>
                    <a href="{{ route('products.index') }}">
                        <i class="bi bi-check-circle"></i>
                        Products</a>
                </li>

                <li>
                    <a href="{{ route('deals') }}">
                        <i class="bi bi-tag"></i>
                        Deals</a>
                </li>

                <li>
                    <a href="{{ route('strains') }}">
                    <i class="bi bi-tree"></i>
                    Strains</a>
                </li>

                @if(Session::has('business_id') == true)
                <li class="dropdown userAuthDropdown customer-dropdown customer-dropdown-mobile"><a href="{{ route('businessprofile') }}"><span><i class="fas fa-user-circle" style="font-size: 25px;"></i></span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                      <li><a href="{{ route('businessprofile') }}">Dashboard</a></li>
                      <li><a href="{{ route('businessaccountsettings') }}">Account Settings</a></li>
                      <li><a href="{{ route('managecustomeraccount') }}">Back to Customer Account</a></li>
                      <hr>
                      <li><a href="{{ route('businesslogout') }}" onclick="return confirm('Are you sure you want to logout?');">Logout</a></li>
                    </ul>
                </li>
              @else

            @if (Session::has('customer_id') == false)
               @else
               <li class="dropdown userAuthDropdown customer-dropdown customer-dropdown-mobile"><a href="#"><span><i class="fas fa-user-circle" style="font-size: 25px;"></i></span> <i class="bi bi-chevron-down"></i></a>

                <ul>
                  <li><a href="{{ route('profile') }}">View Account</a></li>
                  <li><a href="{{ route('accountsettings') }}">Account Settings</a></li>
                  <li><a href="{{ route('favorites') }}">Favorits</a></li>
                  <li><a href="{{ route('recentlyviewed') }}">Recently Viewed</a></li>
                  <li><a href="{{ route('managemybusiness') }}">Manage My Business</a></li>
                  <li><a href="{{ route('logout') }}" onclick="return confirm('Are you sure you want to logout?');">Logout</a></li>
                  </ul>
                 </li>
               @endif
               @endif

               <li class="mb-site-logo">
                   <a href="{{ route('index') }}">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Site Logo">
                    </a>
               </li>

            </ul>
        </div>
    </div>

</header>

