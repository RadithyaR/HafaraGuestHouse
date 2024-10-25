<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')

</head>
<!-- body -->

<body>
        @include('home.header')

        <!-- Breadcrumb Section Begin -->
   <div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Our Rooms</h2>
                    <div class="bt-option">
                        <a href="{{route('home')}}">Home</a>
                        <span>History</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

        <div class="row">
            <div class="container">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="container">
                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-end">
                            <form action="{{route('check-availability')}}" method="post" class="book_now" style="text-align: center;">
                                @csrf
                                <input type="hidden" name="checkin_date" value="{{ \Carbon\Carbon::now()->toDateString() }}" class="me-2">
                                <input type="hidden" name="checkout_date" value="{{ \Carbon\Carbon::now()->addDay()->toDateString() }}" class="me-2">
                                <button type="submit" class="btn btn-outline-success">+ Add Item</button>
                            </form>                            
                        </div>
                    </div>

                    <section class="section">
                        <div class="card mb-3">
                            <div class="card-body">
                                <!-- Tabel responsive -->
                                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Room Type</th>
                                <th>Check-in Date</th>
                                <th>Check-out Date</th>
                                <th>Jumlah Kamar</th>
                                <th>Harga Per Kamar</th>
                                <th>Tambahan Kasur</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0; 
                            @endphp
                            @foreach ($cartItems as $item)
                                @php
                                    $stayDuration = \Carbon\Carbon::parse($item->checkin_date)->diffInDays(
                                        \Carbon\Carbon::parse($item->checkout_date),
                                    );

                                    $subtotal = $item->roomType->price * $item->jumlah_kamar * $stayDuration;

                                    if ($item->is_additional_bed) {
                                        $subtotal += 50000;
                                    }

                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>{{ $item->roomType->name }}</td>
                                    <td>{{ $item->checkin_date }}</td>
                                    <td>{{ $item->checkout_date }}</td>
                                    <td>{{ $item->jumlah_kamar }}</td>
                                    <td>Rp{{ number_format($item->roomType->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->is_additional_bed ? 'Yes' : 'No' }}</td>
                                    <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6"><strong>Total:</strong></td>
                                <td><strong>Rp{{ number_format($total, 0, ',', '.') }}</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

                    <div class="row justify-content-end mb-3">
                        <div class="col-auto">
                            <form action="{{ route('booking.bookRoom') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Check Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--  footer -->
    @include('home.footer')
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
