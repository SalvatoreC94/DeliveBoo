<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('page-title') | {{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')

        <!--Fontwaesome--> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <header class="mb-5">
          <nav class="navbar navbar-expand-lg shadow">
            <div class="container">
                <a class="" href="/login">
                  <img class="logo-nav" src="{{ asset('../storage/images/Logo-deliveBoo.svg') }}" alt="logo-deliveBoo">
                </a>
                <div class="collapse navbar-collapse d-flex justify-content-end aligne-items-center" id="navbarText">
                  <div>
                    <a href="{{ route('user.profile') }}" class="mx-4 ">
                      <i class="icon-profile fa-solid fa-user"></i>
                    </a>
                  </div>
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf

                      <button type="submit" class="logout ibm-plex-mono-regular button-menu mt-2">
                          Log Out
                      </button>
                  </form>
                </div>
            </div>
          </nav>

            {{-- <nav class="navbar bg-body-tertiary fixed-top">
                <div class="container-fluid">
                  <a class="navbar-brand" href="#">Offcanvas navbar</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                      <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                          </a>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                              <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                          </ul>
                        </li>
                      </ul>
                      <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                      </form>
                    </div>
                  </div>
                </div>
            </nav> --}}
        </header>

        <main>
            <div class="container p-0">
                @yield('main-content')
            </div>
        </main>
    </body>
</html>

<style>
 .icon-profile{
  color: #2f2f2f;
  font-size: 30px;
 }
 .icon-profile:hover{
  color: #fac200;
 }

 .logout{
  font-size: 15px;
 }

 .navbar{
  background-color: white;
  box-shadow: 
 }
</style>
