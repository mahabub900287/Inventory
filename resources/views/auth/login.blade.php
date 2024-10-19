<!doctype html>
<html lang="en">

<head>
    <x-admin.includes.styles>
        <x-slot name="topStyle">
            {{ $topStyle ?? '' }}
        </x-slot>

        <x-slot name="bottomStyle">
            {{ $bottomStyle ?? '' }}
        </x-slot>
    </x-admin.includes.styles>
</head>

<body>
    {{-- <div class="home-btn d-none d-sm-block">
        <a href="{{ url('/') }}" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div> --}}
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-6">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20 p-2">Welcome Back !</h5>
                                <p class="text-white-50 pb-3">Sign in to continue to Avocado Communication</p>
                                <a href="javascript:void(0)" class="logo logo-admin">
                                    <img src="{{ asset('assets/admin/images/logo/logo.png') }}" height="14"
                                        alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="p-3">
                                <form method="POST" action="{{ route('login') }}" class="mt-4">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label" for="username">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="email"
                                            type="email" placeholder="Enter your email" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" placeholder="Enter password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="customControlInline">Remember
                                                    me</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light"
                                                type="submit">Log In</button>
                                        </div>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <div class="mt-2 mb-0 row">
                                            <div class="col-6 mt-4">
                                                <span>Don’t have an account ?</span><a href="{{ route('register') }}">
                                                    Sign Up</a>
                                            </div>
                                            <div class="col-6 mt-4 text-end">
                                                <a href="{{ route('password.request') }}"><i class="mdi mdi-lock"></i>
                                                    Forgot your password?</a>
                                            </div>
                                        </div>
                                    @endif
                                </form>

                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <p class="mb-0">©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Avocado Communication Crafted with <i
                                class="mdi mdi-heart text-danger"></i> by
                            <a href="https://itclanbd.com/" target="blank"><img
                                    src="{{ asset('assets/admin/images/logo/ITclan.png') }}" height="14"
                                    alt="logo"></a>
                        </p>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- JAVASCRIPT -->
    <x-admin.includes.scripts>
        <x-slot name="topScript">
            {{ $topScript ?? '' }}
        </x-slot>

        <x-slot name="bottomScript">
            {{ $bottomScript ?? '' }}
        </x-slot>

    </x-admin.includes.scripts>
</body>

</html>
