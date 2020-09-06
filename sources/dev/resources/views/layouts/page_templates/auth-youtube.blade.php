<div class="wrapper ">
  @include('layouts.navbars.sidebar')
  <div class="main-panel">
    @include('layouts.navbars.navs.auth-youtube')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>