<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')

</head>
<!-- body -->

<body>
    <!-- header Section Begin -->
    @include('home.header')
    <!-- header Section end -->

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Check Availability</h2>
                        <div class="bt-option">
                            <a href={{route('home')}}>Home</a>
                            <span>Check Availability</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <div class="row">
        <div class="container">
            <h4 style="text-align: center; margin-bottom: 30px;">Find your perfect stay from {{ $checkin_date }}
                to {{ $checkout_date }}</h4>

            <form action="{{route('check-availability')}}" method="post" class="book_now" style="text-align: center; margin-bottom: 20px;">
                @csrf
                <label for="checkin_date" class="me-2">Check-In Date:</label>
                <input type="date" name="checkin_date" value="{{ $checkin_date }}" required class="me-2">
                <label for="checkout_date" class="me-2">Check-Out Date:</label>
                <input type="date" name="checkout_date" value="{{ $checkout_date }}" required class="me-2">
                <button type="submit" class="button">Check Availability</button>
            </form>       
            <section class="rooms-section spad">
                <div class="container">
                    <div class="row">
                        @foreach ($availableRoomTypes as $roomType)
                        <div class="col-lg-4 col-md-6">
                            <div class="room-item">
                                <img src="room/{{ $roomType->image }}" alt="{{ $roomType->name }}" />
                                <div class="ri-text">
                                    <h4>{{ $roomType->name }}</h4>
                                    <h3>Rp{{ $roomType->price }}<span>/Pernight</span></h3>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="r-o">Available Room:</td>
                                                <td>{{ $roomType->rooms_count }}</td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Capacity (Adults):</td>
                                                <td>{{$roomType->capacity}}</td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Capacity (Kids):</td>
                                                <td>{{$roomType->capacity_kids}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @if( $roomType->rooms_count  != 0)
                                    <a href="{{ route('book_room', ['id' => $roomType->id, 'checkin_date' => $checkin_date, 'checkout_date' => $checkout_date]) }}" class="primary-btn">More Details</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
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
