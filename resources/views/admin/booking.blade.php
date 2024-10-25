<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Sidebar Navigation start-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 no-margin-bottom">Booking</h2>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Harga Total</th>
                                <th>Fine Reason</th>
                                <th>Fine Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Payment Status</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $index => $booking)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->checkin_date }}</td>
                                    <td>{{ $booking->checkout_date }}</td>
                                    <td>{{ $booking->total_price }}</td>
                                    <td>{{ $booking->remarks ?? '-' }}</td>
                                    <td>{{ $booking->fine_price ?? '-' }}</td>
                                    <td>{{ Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}</td>
                                    <td>{{ $booking->status }}</td>
                                    <td>{{ $booking->payment->status }}</td>
                                    <td>
                                        @if ($booking->status == 'confirmed' || $booking->status == 'done')
                                            <!-- Button to toggle the detail row -->
                                            <a type="button" class="btn btn-info btn-sm" data-toggle="collapse"
                                                data-target="#details{{ $booking->id }}">
                                                <i class="ti ti-eye"></i> </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($booking->status == 'pending')
                                            @if ($booking->payment->status == 'paid')
                                                <a href="{{ route('admin.bookings.detailconfirm', $booking->id) }}"
                                                    class="btn btn-sm btn-success">Confirm</a>
                                            @endif
                                            <a href="{{ route('admin.bookings.cancel', $booking->id) }}"
                                                class="btn btn-sm btn-warning">Cancel</a>
                                        @endif
                                        <a href="{{ route('admin.bookings.delete', $booking->id) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure to delete this booking?')">Delete</a>
                                        @if ($booking->status == 'confirmed')
                                            <a href="{{ route('admin.bookings.detailcheckout', $booking->id) }}"
                                                class="btn btn-sm btn-primary">Checkout</a>
                                        @endif
                                    </td>
                                </tr>
                                @if ($booking->status == 'confirmed' || $booking->status == 'done')
                                    <tr id="details{{ $booking->id }}" class="collapse">
                                        <td colspan="9">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Room Type</th>
                                                        <th>Room Number</th>
                                                        <th>Jumlah Kamar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($booking->bookingDetail as $index => $detail)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $detail->room->roomTypes->name }}</td>
                                                            <td>{{ $detail->room->room_number }}</td>
                                                            <td>{{ $detail->jumlah_kamar }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>


    <!-- footer-->
    @include('admin.footer')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
