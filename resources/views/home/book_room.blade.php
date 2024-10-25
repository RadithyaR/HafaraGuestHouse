<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        label {
            display: inline-block;
            width: 200px;
        }

        input {
            width: 100%;
        }
    </style>
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        @include('home.header')
    </header>

    <div class="our_room">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="titlepage">
                        <h2>Book Room</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div id="serv_hover" class="room">
                        <div style="padding: 20px" class="room_img">
                            <figure><img style="height: 300px; width: 800px;" src="/room/{{ $roomType->image }}"
                                    alt="#" /></figure>
                        </div>
                        <div class="bed_room">
                            <h3>{{ $roomType->name }}</h3>
                            <p style="padding: 12px">{{ $roomType->description }}</p>
                            <h5>Kapasitas : {{ $roomType->capacity }}</h5>
                            <h4>price : {{ $roomType->price }}</h4>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h1 style="font-size: 40px!important;">Book Room</h1>
                    <h4 style="font-size: 20px">Booking for room from {{ $checkin_date }} to {{ $checkout_date }}</h4>

                    <div>

                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-bs-dismiss="alert">x</button>
                                {{ session()->get('message') }}
                            </div>
                        @endif

                    </div>

                    @if ($errors)
                        @foreach ($errors->all() as $errors)
                            <li style="color: red;">
                                {{ $errors }}
                            </li>
                        @endforeach
                    @endif

                    <form action="{{ url('add_to_cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="roomType_id" value="{{ $roomType->id }}">
                        <input type="hidden" name="roomType_id" value="{{ $roomType->id }}">
                        <input type="hidden" name="checkin_date" value="{{ $checkin_date }}">
                        <input type="hidden" name="checkout_date" value="{{ $checkout_date }}">

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $user->phone }}" required>
                        </div>
                        <div class="form-group">
                            <label for="room_quantity">Jumlah kamar:</label>
                            <select class="form-control" id="jumlah_kamar" name="jumlah_kamar" required>
                                @for ($i = 1; $i <= $roomType->rooms_count; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="additionalBed" value="1"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Additional Bed
                            </label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="additionalBed" value="0"
                                id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                No Additional Bed
                            </label>
                        </div>
                        <div class="form-group">
                            <span class="badge rounded-pill bg-light text-dark">If you want to add additional bed, you
                                will be charged Rp 50,000</span>
                        </div>

                        <!-- More booking details can be added here -->

                        <button type="submit" class="btn btn-primary mt-1">Add to Cart</button>
                    </form>


                </div>


            </div>
        </div>
    </div>

    <!-- end header inner -->
    <!--  footer -->
    @include('home.footer')

    <script type="text/javascript">
        $(function() {
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();

            if (month < 10)
                month = '0' + month.toString();

            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            $('#startDate').attr('min', maxDate);
            $('#endDate').attr('min', maxDate);
        });
    </script>
    <!--javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
