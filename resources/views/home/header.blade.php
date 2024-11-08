    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
        <div class="canvas-open">
            <i class="icon_menu"></i>
        </div>
            <div class="offcanvas-menu-wrapper">
                <div class="canvas-close">
                    <i class="icon_close"></i>
                </div>
                <div class="header-configure-area">
                @if (Route::has('login'))
                    @auth
                        <!-- Show user dropdown when logged in -->
                        <div class="language-option">
                            <span>{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></span>
                            <div class="flag-dropdown">
                                <ul>
                                    <li>
                                        <a href="{{ route('profile.show') }}">
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <!-- Logout Form -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                                Log Out
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                @else
                    <a href="{{ route('login') }}" class="bk-btn" style="background: #00523B;">Log In</a>

                    @endauth
                @endif
                </div>

                <nav class="mainmenu mobile-menu">
                    <ul>
                        <li><a href="{{route('home')}}">Beranda</a></li>
                        <li><a href="{{route('rooms')}}">Ruangan</a></li>
                        <li><a href="{{route('about_us')}}">Tentang Kami</a></li>
                        <li><a href="{{route('contact_us')}}">Kontak</a></li>
                        <li><a href="{{route('history')}}">History</a></li>
                      <li><a href="{{route('cart.index')}}">Keranjang</a></li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap">

                </div>
                <ul class="top-widget mt-4">
                    <li><i class="fa fa-phone"></i> (+62) 81384930391</li>
                    <li><i class="fa fa-instagram"></i> @@hafaraguesthousesyariah</li>
                </ul>
            </div>
    </div>
    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <header class="header-section header-normal">
        <div class="top-nav">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 d-flex align-items-center">
                        <ul class="tn-left list-inline mb-0">
                            <li class="list-inline-item">
                                <i class="fa fa-phone"></i> (+62) 81384930391
                            </li>
                            <li class="list-inline-item mx-3">
                                <i class="fa fa-instagram"></i> @@hafaraguesthousesyariah
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-5 d-flex justify-content-end align-items-center">
                        <div class="tn-right">
                            <div class="top-social">
                                
                            </div>
                            
                            @if (Route::has('login'))
                                @auth
                                    <!-- Show user dropdown when logged in -->
                                    <div class="language-option">
                                        <span>{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></span>
                                        <div class="flag-dropdown">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('profile.show') }}">
                                                        Profile
                                                    </a>
                                                </li>
                                                <li>
                                                    <!-- Logout Form -->
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <a href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();
                                                           this.closest('form').submit();">
                                                            Log Out
                                                        </a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}" class="bk-btn">Log In</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="bk-btn ml-2" >Register</a>
                                    @endif
                                @endauth
                            @endif
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="{{route("home")}}">
                                <img src="images/logo_hafara.svg" alt="logo-hafara" style="height: 40px; width:auto;">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li><a href="{{route('home')}}">Beranda</a></li>
                                    <li><a href="{{route('rooms')}}">Ruangan</a></li>
                                    <li><a href="{{route('about_us')}}">Tentang Kami</a></li>
                                    <li><a href="{{route('contact_us')}}">Kontak</a></li>
                                    <li><a href="{{route('history')}}">History</a></li>
                                    <li><a href="{{route('cart.index')}}">Keranjang</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>