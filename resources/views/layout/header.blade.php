<!-- Navigation -->
@auth
<nav class="main-header navbar navbar-expand navbar-dark mx-background-top-linear">
  <ul>
    <div class="col-4"></div>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item-d-none d-sm-inline-block">
      <a href="mainboard" class="nav-link home_s">Home</a>
    </li>
    <ul>
      <div class="col-1"></div>
    </ul>
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" role="button">
        <i class="fas fa-bars toggle_g"></i>
      </a>
    </li>
  </ul>
  <ul>
    <div class="col-1"></div>
  </ul>
</nav>
@endauth

@guest
<header>
  <div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
      <div class="container">
        <a class="navbar-brand" href="/"> IIAP </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            @if(Request::url('login'))
            <li class="nav-item">
              <a class="nav-link" href="login">{{__('Sign in')}}</a>
            </li>
            @endif

            @if(Request::url('register'))
            <li class="nav-item">
              <a class="nav-link" href="register">{{__('Sign up')}}</a>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>
@endguest