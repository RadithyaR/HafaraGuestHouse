<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Hafara Guesthouse Syariah</title>

    <!-- Custom fonts -->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles -->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('images/hafara.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px;
        }

        .bg-login-image {
            background-image: url('images/hafara.jpg');
            background-size: cover;
            background-position: center;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
            position: relative;
        }

        .bg-login-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        .logo-image{
            width: auto; /* Sesuaikan ukuran logo */
            height: 70px;
            border-radius: inherit;
        }

        .form-control-user {
            height: 50px;
            padding: 10px 20px;
            font-size: 14px;
            border: 1px solid #e3e6f0;
            transition: all 0.3s ease;
        }

        .form-control-user:focus {
            border-color: #4e73df;
            box-shadow: 0 0 15px rgba(78, 115, 223, 0.1);
        }

        .btn-primary {
            height: 50px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: linear-gradient(45deg, #4e73df, #224abe);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
            background: linear-gradient(45deg, #224abe, #4e73df);
        }

        .custom-control-label {
            font-size: 14px;
            color: #666;
        }

        .card-body {
            padding: 0;
        }

        .p-5 {
            padding: 3rem !important;
        }

        hr {
            margin: 2rem 0;
            opacity: 0.1;
        }

        .small {
            font-size: 13px;
            color: #666;
            transition: all 0.3s ease;
        }

        .small:hover {
            color: #4e73df;
            text-decoration: none;
        }

        .text-gray-900 {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .error-message {
            font-size: 12px;
            color: #e74a3b;
            margin-top: 5px;
            display: block;
        }

        /* Animation for card */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: slideIn 0.5s ease-out forwards;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <a href="{{route('home')}}">
                                            <img src="images/logo_hafara.svg" alt="Brand Logo" class="logo-image mb-4">
                                        </a> 
                                        <h1 class="h4 text-gray-900">Welcome Back!</h1>
                                        <p class="text-muted mb-4">Please sign in to your account</p>
                                    </div>
                                    <form class="user mb-4" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                placeholder="Enter Email Address...">
                                            @error('email')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                placeholder="Password">
                                            @error('password')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                                <label class="custom-control-label" for="remember">Remember Me</label>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary btn-block btn-user" style="background: linear-gradient(135deg, #00523B, #003366);">
                                            Sign In
                                        </button>
                                    </form>
                                    <div class="text-center mb-2">
                                        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <span class="small text-muted">Don't have an account? </span>
                                        <a class="small font-weight-bold" href="{{ route('register') }}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="admin/js/sb-admin-2.min.js"></script>
</body>

</html>