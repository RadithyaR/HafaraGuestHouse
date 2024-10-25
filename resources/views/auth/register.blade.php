<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Mazer Admin Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">

    <!-- Mazer CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/auth.css') }}">
</head>

<body>
    <script src="{{ asset('admin/assets/static/js/initTheme.js') }}"></script>

    <div id="auth">
        <div class="row h-100">
            <!-- Left Side: Form Section -->
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('images/logo_hafara.svg') }}" alt="Logo">
                        </a>
                    </div>
                    <h1 class="auth-title">Sign Up</h1>
                    <p class="auth-subtitle mb-5">Enter your details to create your account.</p>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <!-- Email Input -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" name="email" 
                                   placeholder="Email" value="{{ old('email') }}" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>

                        <!-- Username Input -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="name" 
                                   placeholder="Username" value="{{ old('name') }}" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" 
                                   placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" 
                                   name="password_confirmation" placeholder="Confirm Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">
                            Sign Up
                        </button>
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>
                            Already have an account? 
                            <a href="{{ route('login') }}" class="font-bold">Log in</a>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Placeholder Section -->
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <!-- Optional: Add background image or content here -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>
