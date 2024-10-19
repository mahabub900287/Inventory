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
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row pt-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="first_name">First Name</label>
                                            <input id="first_name" type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ old('first_name') }}" required
                                                autocomplete="first_name" autofocus>

                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="last_name">last Name</label>
                                            <input id="last_name" type="text"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                name="last_name" value="{{ old('last_name') }}" required
                                                autocomplete="last_name" autofocus>

                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="last_name">Company Name</label>
                                            <input id="company_name" type="text"
                                                class="form-control @error('company_name') is-invalid @enderror"
                                                name="company_name" value="{{ old('company_name') }}" required
                                                autocomplete="company_name" autofocus>

                                            @error('company_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="username">Email</label>
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                id="email" type="email" placeholder="Enter username"
                                                name="email" value="{{ old('email') }}" required
                                                autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="country">Country</label>
                                            <input id="country" type="text"
                                                class="form-control @error('country') is-invalid @enderror"
                                                name="country" value="{{ old('country') }}" required
                                                autocomplete="country" autofocus>

                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="userpassword">Password</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password"
                                                placeholder="Enter password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="userpassword">Confirm Password</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                        <div class="col-6 mt-4">
                                            <span>Already have an account ?</span><a href="{{ route('login') }}">
                                                Sign In</a>
                                        </div>
                                        <div class="col-md-6 mb-3 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light"
                                                type="submit">Sign Up</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <p class="mb-0">©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Avocado Communication Crafted with <i
                                class="mdi mdi-heart text-danger"></i>
                            by
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
