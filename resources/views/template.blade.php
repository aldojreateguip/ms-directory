<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  @vite(['resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <title>Document</title>
  <!-- <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css"></script> -->

</head>

<body class="sidebar-mini" style="height: auto;">

  <div class="wrapper">
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="/" class="brand-link">
        <span class="brand-text font-weight-light">Admin</span>
      </a>
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block">User</a>
          </div>
        </div>
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input type="search" class="form-control form-control-sidebar" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="bi bi-search"></i>
              </button>
            </div>
            <div class="sidebar-search-results">
              <div class="list-group">
                <a href="#" class="list-group-item">
                  <div class="search-title">
                    <strong class="text-light"></strong>
                    N
                    <strong class="text-light"></strong>
                    o<strong class="text-light"></strong>
                    <strong class="text-light"></strong>
                    e<strong class="text-light"></strong>
                    l<strong class="text-light"></strong>
                    e<strong class="text-light"></strong>
                    m<strong class="text-light"></strong>
                    e<strong class="text-light"></strong>
                    n<strong class="text-light"></strong>
                    t<strong class="text-light"></strong>
                    <strong class="text-light"></strong>
                    f<strong class="text-light"></strong>
                    o<strong class="text-light"></strong>
                    u<strong class="text-light"></strong>
                    n<strong class="text-light"></strong>
                    d<strong class="text-light"></strong>
                    !<strong class="text-light"></strong>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-is-opening menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Forms
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: block;">
                <li class="nav-item">
                  <a href="pages/forms/general.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>General Elements</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Advanced Elements</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Editors</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Validation</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

  </div>
</body>

</html>