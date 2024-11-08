<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forgot Password - Hafara Guesthouse Syariah</title>

    <!-- Custom fonts -->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles -->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/hafara2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
        }

        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            overflow: hidden;
            animation: slideIn 0.5s ease-out forwards;
        }

        .logo-image{
            width: auto; /* Sesuaikan ukuran logo */
            height: 50px;
            border-radius: inherit;
        }

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

        .bg-password-image {
            background-image: url('images/hafara2.jpg');
            background-size: cover;
            background-position: center;
        }

        .form-control-user {
            border: 1px solid #e3e6f0;
            transition: all 0.3s ease;
            height: 50px;
            padding: 10px 20px;
            font-size: 14px;
        }

        .form-control-user:focus {
            border-color: #4e73df;
            box-shadow: 0 0 15px rgba(78, 115, 223, 0.1);
        }

        .btn-primary {
            background: linear-gradient(45deg, #4e73df, #224abe);
            border: none;
            transition: all 0.3s ease;
            padding: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #224abe, #4e73df);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }

        .text-green-600 {
            color: #0f9d58;
            font-weight: 500;
            padding: 10px;
            border-radius: 5px;
            background-color: rgba(15, 157, 88, 0.1);
        }

        .small {
            transition: all 0.3s ease;
        }

        .small:hover {
            color: #4e73df;
            text-decoration: none;
        }

        hr {
            margin: 1.5rem 0;
            opacity: 0.1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center w-100">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <a href="{{route('home')}}">
                                            <img src="images/logo_hafara.svg" alt="Brand Logo" class="logo-image mb-4">
                                        </a> 
                                        <h1 class="h4 text-gray-900 font-weight-bold">Forgot Your Password?</h1>
                                        <p class="text-muted mb-4">
                                            We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!
                                        </p>
                                    </div>

                                    @if (session('status'))
                                        <div class="alert alert-success mb-4">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <x-validation-errors class="mb-4 text-danger" />

                                    <form class="user mb-4" method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" 
                                                   class="form-control form-control-user"
                                                   id="email" 
                                                   name="email" 
                                                   placeholder="Enter Email Address"
                                                   value="{{ old('email') }}" 
                                                   required 
                                                   autofocus>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" style="background: linear-gradient(135deg, #00523B, #003366);">
                                            Send Password Reset Link
                                        </button>
                                    </form>
                                    
                                    <div class="text-center mb-2">
                                        <a class="small" href="{{ route('register') }}">
                                            Create an Account!
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <span class="text-muted small">Remember your password? </span>
                                        <a class="small font-weight-bold" href="{{ route('login') }}">
                                            Login Here
                                        </a>
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