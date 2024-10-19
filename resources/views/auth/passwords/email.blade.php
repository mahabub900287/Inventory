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
                <div class="col-md-8 col-lg-7 col-xl-7">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20 p-2">Welcome Back !</h5>
                                <p class="text-white-50 pb-3">Reset Password to continue to Avocado Communication</p>
                                <a href="javascript:void(0)" class="logo logo-admin">
                                    <img src="{{ asset('assets/admin/images/logo/logo.png') }}" height="14"
                                        alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">

                            <div class="p-3">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="row mb-3 mt-4">
                                        <div class="col-md-10">
                                            @if (session('status'))
                                                <div class="alert alert-success mt-2" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                        </div>
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
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
