<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>HafaraGuestHouse</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="/images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <style>
        /*style untuk our room di home */
        /* Atur ukuran gambar agar sesuai dengan kotaknya */
        .room_img img {
            width: 100%;
            height: 200px;
            /* Anda bisa menyesuaikan tinggi sesuai keinginan */
            object-fit: cover;
            /* Memastikan gambar tidak terdistorsi dan proporsional */
        }

        /* Atur ukuran kotak agar konsisten */
        .room {
            min-height: 400px;
            /* Anda bisa menyesuaikan tinggi sesuai kebutuhan */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Atur tata letak grid responsif */
        .room .bed_room {
            flex-grow: 1;
            /* Mengisi ruang kosong */
        }

        .nav-item .active {
            font-weight: bold;
        }

        /* Gaya responsif untuk layar yang lebih kecil */
        @media (max-width: 768px) {
            .room_img img {
                height: 150px;
                /* Ukuran lebih kecil di perangkat mobile */
            }

            .room {
                min-height: 350px;
            }
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Pastikan body minimal setinggi layar */
        }

        .container {
            flex: 1;
            /* Mengisi sisa ruang yang tersedia */
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Pusatkan konten secara vertikal */
            align-items: center;
            /* Pusatkan konten secara horizontal */
            padding: 20px;
            /* Tambahkan padding untuk ruang */
        }

        h1 {
            margin-bottom: 20px;
            /* Spasi di bawah judul */
        }

        .btn-success {
            margin-top: 20px;
            /* Spasi di atas tombol */
        }

        footer {
            background-color: #f8f9fa;
            /* Warna latar belakang footer */
            padding: 20px 0;
            /* Padding atas dan bawah */
        }

        .footer {
            text-align: center;
            /* Pusatkan teks di footer */
        }

        .badge {
            font-size: 1.2em;
            /* Menyesuaikan ukuran font badge */
            margin: 0 5px;
            /* Memberikan sedikit spasi di sekitar badge */
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>


</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="/images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="{{ url('/') }}"><img style="height: 60px;"
                                            src="/images/hafara_logo.png" alt="#" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="nav-item {{ Request::is('contact_us') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ url('contact_us') }}">Contact Us</a>
                                    </li>
                                    <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ url('about') }}">About</a>
                                    </li>
                                    @if (Route::has('login'))
                                        @auth
                                            <x-app-layout>

                                            </x-app-layout>
                                        @else
                                            <li class="nav-item" style="padding-right : 10px;">
                                                <a class="btn btn-success" href="{{ url('login') }}">Log in</a>
                                            </li>

                                            @if (Route::has('register'))
                                                <li class="nav-item">
                                                    <a class="btn btn-primary" href="{{ url('register') }}">Register</a>
                                                </li>
                                            @endif
                                        @endauth
                                    @endif

                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="text-center">
            <h1 class="mt-5">Thank You!</h1>
            <p>Your order
                <span class="badge bg-success">{{ $payment->external_id }}</span>
                has been paid successfully.
            </p>
            <p><strong>Date Paid:</strong> <span
                    class="badge bg-info">{{ $payment->created_at->format('d M Y, H:i') }}</span></p>
            <a href="{{ route('home') }}" class="btn btn-success mt-3">Back to Home</a>
        </div>
    </div>

    <!--  footer -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class=" col-md-4">
                        <h3>Contact US</h3>
                        <ul class="conta">
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> Address</li>
                            <li><i class="fa fa-mobile" aria-hidden="true"></i> +01 1234569540</li>
                            <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> demo@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>Menu Link</h3>
                        <ul class="link_menu">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="about.html"> about</a></li>
                            <li><a href="room.html">Our Room</a></li>
                            <li><a href="gallery.html">Gallery</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>News letter</h3>
                        <form class="bottom_form">
                            <input class="enter" placeholder="Enter your email" type="text"
                                name="Enter your email">
                            <button class="sub_btn">subscribe</button>
                        </form>
                        <ul class="social_icon">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/js/custom.js"></script>
    <script type="text/javascript">
        $(window).scroll(function() {
            sessionStorage.scrollTop = $(this).scrollTop();
        });
        $(document).ready(function() {
            if (sessionStorage.scrollTop != "undefined") {
                $(window).scrollTop(sessionStorage.scrollTop);
            }
        });
    </script>


</body>

</html>
