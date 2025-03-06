<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <style>
        /* Memperbesar dropdown untuk jumlah entri */
        .dataTables_length label {
            font-size: 18px !important;
        }

        .dataTables_length label select {
            font-size: 18px !important;
            padding: 8px 12px !important;
            margin-left: 10px !important;
            border-radius: 6px !important;
            border: 1px solid #ccc !important;
            width: 80px !important;
        }


        /* Memperbaiki ukuran input search */
        .dataTables_filter input {
            font-size: 18px;
            padding: 8px;
            margin-left: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        /* Memperbaiki padding dan spasi di tabel */
        table.dataTable td,
        table.dataTable th {
            padding: 12px 15px;
            font-size: 16px;
        }

        .dataTables_paginate .paginate_button {
            padding: 8px 16px;
            margin: 4px;
            font-size: 18px;
            border-radius: 6px;
        }

        .dtrg-group {
            background-color: #f2f2f2;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
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
                        <h1 class="h3 mb-0 text-gray-800">Report</h1>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <!-- Tabel responsive -->
                                <div class="table-responsive">
                                    <table id="example" class="display">
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
                                                <th>Feedback</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bookings as $index => $booking)
                                                <tr data-booking-detail="{{ $booking->bookingDetail }}">
                                                    <td>
                                                        <i class="bi bi-eye"></i>
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

                                                    </td>
                                                    <td>
                                                        <a href="{{ route('report.print_invoice', $booking->id) }}"
                                                            class="btn btn-primary"><i class="bi bi-receipt"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
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
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.5.0/js/dataTables.rowGroup.js"></script>
    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"
        integrity="sha384-lZnR26hXnq+Q1s63G9+B+uxJcg3/P0pMAeLFi1u/xeIYzHrPjXjhhmS5u5g6FVdC" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });

            $('#example tbody').on('click', 'td:first-child', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Ambil data-booking-detail dari atribut HTML
                    var bookingDetail = JSON.parse(tr.attr('data-booking-detail'));

                    // Tampilkan data bookingDetail di dalam row.child
                    row.child(format(bookingDetail)).show();
                    tr.addClass('shown');
                }
            });

            function format(details) {
                console.log(details);
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
