<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Template</title>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="sweetalert2.all.min.js"></script>
  @vite(['resources/js/app.js', 'resources/css/app.css'])



</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-dark mx-background-top-linear">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="#" class="nav-link" data-widget="pushmenu" role="button">
            <i class="fas fa-bars"></i>
          </a>
        </li>
        <li class="nav-item-d-none d-sm-inline-block">
          <a href="/" class="nav-link">Home</a>
        </li>
        <li class="nav-item-d-none d-sm-inline-block">
          <a href="admin" class="nav-link">Dashboard</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="/" class="brand-link">
        <img src="./assets/iiap_logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">IIAP</span>
      </a>

      <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-overflow-x">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="./assets/user_logo.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              @auth
              {{ Auth::user()->email }}
              @endauth
            </a>
          </div>
        </div>

        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <div class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">TABLES</li>

            <li class="nav-item">
              <a href="ubigeo" class="nav-link">
                <i class="fa-sharp fa-solid fa-earth-americas"></i>
                <p>
                  Ubigeo
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="person" class="nav-link">
                <i class="fa-solid fa-person"></i>
                <p>
                  Persona
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="user" class="nav-link">
                <i class="fa-solid fa-user"></i>
                <p>
                  Usuario
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="institution" class="nav-link">
                <i class="fa-regular fa-building"></i>
                <p>
                  Institución
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="institution_person" class="nav-link">
                    <i class="fa-solid fa-building-user"></i>
                    <p>Institución-Persona</p>
                  </a>
                </li>
              </ul>
            </li>

          </ul>
        </div>

      </div>

    </aside>

    <div class="content-wrapper">
      @yield('content')
      @include('table_layout')
    </div>
  </div>

  <div>
    @yield('modals')
  </div>

  <div>
    @yield('scripts')
  </div>
  <script>
    Swal.fire(
      'The Internet?',
      'That thing is still around?',
      'question'
    )
  </script>
</body>

</html>