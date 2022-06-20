@include("partials/head")

<div id="app">
  @include("partials/navigation")

  <main id="main" style="margin-top: 99px;">

       @yield('content')

  </main>
</div>

@include("partials/footer")
