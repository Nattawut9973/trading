<!-- ##### Header Area Start ##### -->
<header class="header-area">
    <!-- Top Header Area -->
    <div class="top-header">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 h-100">
                    <div class="top-header-content h-100 d-flex align-items-center justify-content-between">
                        <!-- Top Headline -->

                        <div class="top-headline">
                            <p>Welcome to <span>Trading site</span></p>
                        </div>
                        <div class="login-faq-earn-money">
                            @guest
                                @if(Route::has('register'))
                                    <a href="{{ url('login') }}"><i class="fa fa-lock"></i><b> Login</b></a>
                                    <a href="{{ url('register') }}" class="login-faq-earn-money"><b>Register</b></a>
                                @endif
                            @else
                                @if(auth()->user()->role_id == 2)
                                    {{--<a href="{{ url('admin/home') }}"><i class="fa fa-gear"></i> Settings</a>--}}
                                @endif
                                <a class="active"> {{ auth()->user()->result }} <i class="fa fa-bitcoin"></i></a>
                                <a href="{{ route('profile') }}">{{ auth()->user()->name }}</a>
                                <a class="login-faq-earn-money" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="cryptos-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-sm-start" id="cryptosNav">
                    <!-- Logo -->
                    <div class="classynav">
                        <ul>
                            <a href="{{ url('/') }}" style="icon: auto"><img
                                        src="{{ asset('frontend/img/brand4.png') }}"
                                        style="animation-direction: alternate"></a>
                            <li><a href="#">GET-TRADING</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('products') }}"><i class="fa fa-area-chart"></i> ราคา</a>
                                    </li>
                                    <li><a href="{{ route('port') }}"><i class="fa fa-database"></i> Port</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="{{ route('posts') }}"></i> NEWS</a></li>
                            <li><a href="#">RANKING</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('ranking') }}"><i class="fa fa-amazon"></i>
                                            Rank</a>
                                    </li>
                                    {{--<li><a href="{{ route('ranking') }}"><i class="fa fa-bar-chart"></i>--}}
                                            {{--Rank</a>--}}
                                    {{--</li>--}}
                                </ul>
                            </li>
                            <li><a href="{{ route('rule') }}"> ABOUT</a></li>
                            @if(Auth::check() && auth()->user()->role_id == 2)
                                <li><a href="#"><i class="fa fa-gear"></i> Setting</a>
                                    <ul class="dropdown">
                                        {{--<li><a href="{{ route('update/round') }}"><i class="fa fa-area-chart"></i>--}}
                                                {{--Update user</a>--}}
                                        {{--</li>--}}
                                        <li><a href="{{ url('admin/home') }}"><i class="fa fa-database"></i> Backend</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->
