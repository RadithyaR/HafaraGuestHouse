<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hafara Guesthouse Syariah</title>

    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/auth.css') }}">

    
</head>

<body>
    <script src="{{ asset('admin/assets/static/js/initTheme.js') }}"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/logo_hafara.svg') }}" alt="Logo">
                        </a>
                    </div>
                    <h3 class="auth-title">Log in</h3>
                    <p class="auth-subtitle mb-5">Log in with your credentials used during registration.</p>

                    <!-- Laravel Login Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Username / Email Input -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="email" class="form-control form-control-xl" 
                                   placeholder="Email or Username" required autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" 
                                   placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label text-gray-600" for="remember">
                                Keep me logged in
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>

                    <!-- Links to Register / Forgot Password -->
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? 
                            <a href="{{ route('register') }}" class="font-bold">Sign up</a>.
                        </p>
                        <p>
                            <a href="{{ route('password.request') }}" class="font-bold">Forgot password?</a>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Section (Empty for Now) -->
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
</body>

</html>
