<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>
    <!-- Sidebar Navigation start-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 no-margin-bottom">Detail Booking</h2>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Booking</h5>

                    <table class="table">
                        <tr>
                            <th>User</th>
                            <td>{{ $bookings->user_name }}</td>
                        </tr>
                        <tr>
                            <th>Room Type</th>
                            <td>{{ $bookings->room_type_name }}</td>
                        </tr>
                        <tr>
                            <th>Check-in Date</th>
                            <td>{{ $bookings->checkin_date }}</td>
                        </tr>
                        <tr>
                            <th>Check-out Date</th>
                            <td>{{ $bookings->checkout_date }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Kamar Dipesan</th>
                            <td>{{ $bookings->jumlah_kamar }}</td>
                        </tr>
                        <tr>
                            <th>Status Booking</th>
                            <td>{{ $bookings->status }}</td>
                        </tr>
                    </table>

                    <hr>

                    <form action="{{ route('admin.bookings.confirm', $bookings->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $bookings->id }}">
                        @for ($i = 0; $i < $bookings->jumlah_kamar; $i++)
                            <div class="form-group">
                                <label for="selectedRoom{{ $i }}">Pilih Kamar yang Tersedia (Kamar
                                    {{ $i + 1 }})</label>
                                <select class="form-control" id="selectedRoom{{ $i }}"
                                    name="selected_room[]" required>
                                    <option value="" disabled selected>-- Pilih Kamar --</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}">Nomor Kamar: {{ $room->room_number }} -
                                            Status: {{ $room->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endfor

                        <div class="form-group">
                            <label for="jumlahKamar">Jumlah Kamar yang Dipilih</label>
                            <input type="number" class="form-control" id="jumlahKamar" name="jumlah_kamar" readonly
                                value="{{ $bookings->jumlah_kamar }}" required>
                        </div>

                        <div class="form-group">
                            <label>Total Kamar Tersedia: {{ $roomscount }}</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Confirm Booking</button>
                    </form>
                </div>
            </div>

        </section>
    </div>


    <!-- footer-->
    @include('admin.footer')

</body>

</html>
