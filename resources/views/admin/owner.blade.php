<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Sidebar Navigation start-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <!-- Canvas for Charts -->
        <section class="section mt-5">
            <div class="container">
                <h4>Total Income and Room Type Frequency</h4>
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="incomeChart"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="roomTypeChart"></canvas>
                    </div>
                </div>
            </div>
        </section>
        <div class="page-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 no-margin-bottom">Booking</h2>
                </div>
            </div>
        </div>
        <form action="{{ route('bookings.export') }}" method="GET">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" required>
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
                                        <!-- Button to toggle the detail row -->
                                        <a type="button" class="btn btn-info btn-sm" data-toggle="collapse"
                                            data-target="#details{{ $booking->id }}">
                                            <i class="ti ti-eye"></i> </a>
                                    </td>
                                </tr>
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

    <!-- Script for Chart.js -->
    <script>
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
                const formattedDate = formatDate(b.created_at);
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
    </script>

</body>

</html>
