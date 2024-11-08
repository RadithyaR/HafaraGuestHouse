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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Bookings</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBookings }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Customer</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Rooms</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRooms }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Message</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalContacts }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->role == 'owner')
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Graphic</h1>
                </div>
                <section class="section mt-5">
                    <div class="container">
                        <h4>Total Income and Room Type Frequency</h4>
                        <div class="row">
                            <div class="col">
                                <!-- Area Chart -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                                    </div>
                                    <div class="card-body">
                                        {{-- <div class="chart-area"> --}}
                                        <canvas id="incomeChart"></canvas>
                                        {{-- </div> --}}
                                        <hr>
                                        {{-- Styling for the area chart can be found in the
                                        <code>/js/demo/chart-area-demo.js</code> file. --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <!-- Bar Chart -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                                    </div>
                                    <div class="card-body">
                                        {{-- <div class="chart-bar"> --}}
                                        <canvas id="roomTypeChart"></canvas>
                                        {{-- </div> --}}
                                        <hr>
                                        {{-- Styling for the bar chart can be found in the
        <code>/js/demo/chart-bar-demo.js</code> file. --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @endif
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
