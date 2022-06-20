@extends('layouts.app')
  <?php
    //  $loc = "Marijuana Listings in " . "$location";
    $loc = "Marijuana Listings in Los Angeles";

    $lat = '';
    $lng = '';
    if(is_null(session('latitude')) && is_null(session('longitude'))) {
        $lat = "34.0522342";
        $lng = "-118.2436849";
    } else {
        $lat = session('latitude');
        $lng = session('longitude');
    }

  ?>
  @section('title', $loc)

  @section('content')

  <section>

      <desktopmap-component :latitude="<?php echo $lat; ?>" :longitude="<?php echo $lng; ?>"></desktopmap-component>
  </section>
@endsection

