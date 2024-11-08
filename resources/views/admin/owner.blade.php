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
                    <div class="page-header">
                        <div class="container-fluid">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h2 class="h5 no-margin-bottom">Report</h2>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('bookings.export') }}" method="GET">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="end_date" class="d-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-success">Export to Excel</button>
                                </div>
                            </div>
                        </div>
                    </form>

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
            const bookings = @json($bookings);
            const bookingIds = bookings.map(b => b.id);
            const totalIncome = bookings.map(b => b.total_price);
            const roomTypes = {};

            bookings.forEach(b => {
                if (b.payment.status === 'paid') {
                    b.booking_detail.forEach(detail => {
                        const roomType = detail.room.room_types.name;
                        if (roomType in roomTypes) {
                            roomTypes[roomType]++;
                        } else {
                            roomTypes[roomType] = 1;
                        }
                    });
                }
            });

            const roomTypeLabels = Object.keys(roomTypes);
            const roomTypeCounts = Object.values(roomTypes);
            roomTypeCounts.push(0);
            const incomeByDate = {};

            function formatDate(dateString) {
                const date = new Date(dateString);
                const options = {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                };
                return new Intl.DateTimeFormat('id-ID', options).format(date);
            }

            bookings.forEach(b => {
                if (b.payment.status === 'paid') {
                    const formattedDate = formatDate(b.checkin_date);
                    let total_price = parseFloat(b.total_price);
                    if (b.fine_price !== null) {
                        total_price += parseFloat(b.fine_price);
                    }
                    if (incomeByDate[formattedDate]) {
                        incomeByDate[formattedDate] += parseFloat(total_price);
                    } else {
                        incomeByDate[formattedDate] = parseFloat(total_price);
                    }
                }
            });

            const dates = Object.keys(incomeByDate);
            const totalIncomePerDate = Object.values(incomeByDate);
            totalIncomePerDate.push(0);
            const ctx1 = document.getElementById('incomeChart').getContext('2d');
            const incomeChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Total Income (IDR)',
                        data: totalIncomePerDate,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx2 = document.getElementById('roomTypeChart').getContext('2d');
            const roomTypeChart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: roomTypeLabels,
                    datasets: [{
                        label: 'Number of Bookings',
                        data: roomTypeCounts,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            
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
