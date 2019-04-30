<!-- Start Header Style -->
<header id="header" class="htc-header header--3 bg__white">
    <!-- Start Mainmenu Area -->
    <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                    <div class="logo">
                        <a href="/">
                            <img src="{{ asset('images/logo/logo.png') }}" alt="logo">
                        </a>
                    </div>
                </div>
                <!-- Start MAinmenu Ares -->
                <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                    <nav class="mainmenu__nav hidden-xs hidden-sm">
                        <ul class="main__menu">
                            <li class="drop">
                                <a href="/">Home</a>
                            </li>
                            <li class="drop">
                                <a href="/about">About</a>
                            </li>
                            <li class="drop">
                                <a href="/contact">Contact</a>
                            </li>
                            @guest()
                                <li class="drop">
                                    <a href="{{ route('login') }}">Login</a>
                                </li><li class="drop">
                                    <a href="{{ route('register') }}">Register</a>
                                </li>
                            @elseauth()
                                <li class="drop">
                                    <a href="/logout">Logout</a>
                                </li>
                            @endauth
                        </ul>
                    </nav>
                    <div class="mobile-menu clearfix visible-xs visible-sm">
                        <nav id="mobile_dropdown">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="/about">About</a></li>
                                <li><a href="/contact">Contact</a></li>
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- End MAinmenu Ares -->
                <div class="col-md-2 col-sm-4 col-xs-3">
                    <ul class="menu-extra">
                        <li class="search search__open hidden-xs"><span class="ti-search"></span></li>
                        <li>
                            <a href="/home">
                                <span class="ti-user"></span>
                            </a>
                        </li>
                        <li class="cart__menu"><span class="ti-shopping-cart"></span></li>
                        <li class="toggle__menu hidden-xs hidden-sm"><span class="ti-menu"></span></li>
                    </ul>
                </div>
            </div>
            <div class="mobile-menu-area"></div>
        </div>
    </div>
    <!-- End Mainmenu Area -->
</header>
<!-- End Header Style -->