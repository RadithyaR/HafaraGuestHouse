<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- sidebar -->
        @include('admin.navigation.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.navigation.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Bookings</h1>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th></th>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $index => $booking)
                                            <tr data-booking-detail="{{ $booking }}">
                                                <td>
                                                    @if ($booking->status == 'checked_in' || $booking->status == 'checked_out')
                                                        <i class="bi bi-eye"></i>
                                                    @endif
                                                </td>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $booking->user->name }}</td>
                                                <td>{{ $booking->checkin_date }}</td>
                                                <td>{{ $booking->checkout_date }}</td>
                                                <td>{{ $booking->total_price }}</td>
                                                <td>{{ $booking->remarks ?? '-' }}</td>
                                                <td>{{ $booking->fine_price ?? '-' }}</td>
                                                <td>{{ Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}
                                                </td>
                                                <td>{{ $booking->status }}</td>
                                                <td>{{ $booking->payment->status }}</td>
                                                <td>
                                                    @if ($booking->status == 'booked')
                                                        @if ($booking->payment->status == 'paid')
                                                            <a href="{{ route('admin.bookings.detailconfirm', $booking->id) }}"
                                                                class="btn btn-sm btn-success"><i
                                                                    class="bi bi-check-circle"></i></a>
                                                        @endif
                                                        <a href="{{ route('admin.bookings.cancel', $booking->id) }}"
                                                            class="btn btn-sm btn-warning"><i
                                                                class="bi bi-x-circle"></i></a>
                                                    @endif
                                                    <a href="{{ route('admin.bookings.delete', $booking->id) }}"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure to delete this booking?')"><i
                                                            class="bi bi-trash3"></i></a>
                                                    @if ($booking->status == 'checked_in')
                                                        <a href="{{ route('admin.bookings.detailcheckout', $booking->id) }}"
                                                            class="btn btn-sm btn-primary">Checkout</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- End page content -->

            </div>
            <!-- End Main Content -->

            <!-- Footer -->
            @include('admin.navigation.footer')
            <!-- End of Footer -->

        </div>
        <!-- End Contenct Wrapper -->

    </div>
    <!--End Page Wrapper -->
    @include('admin.navigation.script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#table1').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });

            $('#table1 tbody').on('click', 'td:first-child', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    var bookingDetail = JSON.parse(tr.attr('data-booking-detail'));
                    if (bookingDetail.status == 'checked_in' || bookingDetail.status == 'checked_out') {
                        row.child(format(bookingDetail)).show();
                        tr.addClass('shown');
                    }
                }
            });

            function format(details) {
                details = details.booking_detail;
                var detailRows = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                    '<thead><tr>' +
                    '<th>#</th>' +
                    '<th>Room Type</th>' +
                    '<th>Room Number</th>' +
                    '<th>Jumlah Kamar</th>' +
                    '<th>Harga</th>' +
                    '</tr></thead><tbody>';

                for (var i = 0; i < details.length; i++) {
                    detailRows += '<tr>' +
                        '<td>' + (i + 1) + '</td>' + // Nomor urut
                        '<td>' + details[i].room.room_types.name + '</td>' + // Akses Room Type
                        '<td>' + details[i].room.room_number + '</td>' + // Akses Room Number
                        '<td>' + 1 + '</td>' + // Akses Jumlah Kamar
                        '<td>' + details[i].room.room_types.price + '</td>' + // Akses Harga
                        '</tr>';
                }

                detailRows += '</tbody></table>';
                return detailRows;
            }
        });
    </script>
</body>

</html>
