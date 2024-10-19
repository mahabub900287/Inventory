<!--Header Start-->
<header class="ic-header-area sticky">
    <div class="ic-mobile-menu-overlay"></div>
    <div class="container">
        <div class="ic-header-wraper">
            <div class="ic-header-brand">
                <a href="">
                    <div class="ic-logo-wrapper">
                        <img src="{{ asset('assets/admin') }}/images/frontend/logo/logo.svg" class="img-fluid "
                            alt="logo" />
                    </div>
                </a>
            </div>


            <div class="ic-navbar-wraper">
                <nav class="ic-navbar ic-mobile-menu-warper">


                    <div class="ic-mobile-logo-close">
                        <div class="logo">
                            <img src="{{ asset('assets/admin') }}/images/frontend/logo/logo.svg" class="img-fluid"
                                alt="logo">
                        </div>
                        <a href="javascript:void(0)" class="ic-menu-close">
                            <i class="ri-close-line"></i>
                        </a>
                    </div>


                    <ul class="ic-navbar-nav">
                        <li class="ic-nav-item">
                            <a href="" class="ic-nav-link active">Home</a>
                        </li>
                        <li class="ic-nav-item">
                            <a href="" class="ic-nav-link">About</a>
                        </li>
                        <li class="ic-nav-item">
                            <a href="" class="ic-nav-link">Features</a>
                        </li>
                        <li class="ic-nav-item">
                            <a href="" class="ic-nav-link">Pricing</a>
                        </li>
                        <li class="ic-nav-item">
                            <a href="" class="ic-nav-link white">Contact</a>
                        </li>

                    </ul>
                    <div class="ic-mobile-social">
                        <div class="contact">
                            <a href="tel:+493027897272">
                                <i class="ri-phone-line"></i>
                                +49 30 27897 272
                            </a>
                            <a href="mailto:admin@fccldhaka.com">
                                <i class="ri-mail-open-line"></i>
                                admin@fccldhaka.com
                            </a>
                        </div>
                    </div>
                </nav>
            </div>


            <div class="ic-navbar-login-reg">
                <div class="ic-navbar-login">
                    @if (Auth::user())
                        <a href="{{ auth()->user()->type == 'admin' ? route('admin.dashboard') : route('company.dashboard') }}"
                            class="ic-btn outline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="ic-btn outline">Login</a>
                    @endif

                    <a href="" class="ic-btn">Get Started</a>
                </div>

                <div class="ic-mobile-login-dropdown">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-user-add-line"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="">Login</a></li>
                            <li><a class="dropdown-item" href="">Get Started</a></li>
                        </ul>
                    </div>
                </div>



                <div class="ic-mobile-menu-icon">
                    <a href="javascript:void(0)" class="ic-mobile-menu-open">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>

            </div>
        </div>
</header>
<!--Header End-->
