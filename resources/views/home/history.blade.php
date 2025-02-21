<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.5.0/css/rowGroup.bootstrap.css">
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

<body>
    @include('home.header')

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>History</h2>
                        <div class="bt-option">
                            <a href="{{ route('home') }}">Beranda</a>
                            <span>History</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <div class="contact">
        <div class="container">
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <!-- Tabel responsive -->
                        <div class="table-responsive">
                            <table id="bookingTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Room Type</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        <th>Jumlah Kamar</th>
                                        <th>Status</th>
                                        <th>Payment Status</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->user_name }}</td>
                                            <td>{{ $booking->room_type_name }}</td>
                                            <td>{{ $booking->checkin_date }}</td>
                                            <td>{{ $booking->checkout_date }}</td>
                                            <td>{{ $booking->jumlah_kamar }}</td>
                                            <td>{{ $booking->status }}</td>
                                            <td>{{ $booking->pstatus }}</td>
                                            <td>{{ $booking->total_price }}</td>
                                            <td>
                                                @if ($booking->pstatus == 'pending')
                                                    <a href="{{$booking->checkout_link}}" class="btn btn-warning btn-sm">
                                                        <i class="bi bi-credit-card"></i> Pay
                                                    </a>
                                                @elseif ($booking->status == 'checked_out' || $booking->status == 'checked_in')
                                                    <a href="{{ route('report.print_invoice', $booking->id) }}"
                                                        class="btn btn-primary"><i class="bi bi-receipt"></i></a>
                                                @else
                                                    -
                                                @endif
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
    </div>
    <p></p>

    <!-- end contact -->
    <!--  footer -->
    @include('home.footer')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.5.0/js/dataTables.rowGroup.js"></script>
    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"
        integrity="sha384-lZnR26hXnq+Q1s63G9+B+uxJcg3/P0pMAeLFi1u/xeIYzHrPjXjhhmS5u5g6FVdC" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#bookingTable').DataTable({
                responsive: true,
                rowGroup: {
                    dataSrc: 2
                },
                order: [
                    [2, 'asc']
                ],
                pageLength: 10,
                lengthMenu: [5, 10, 20, 50],
                language: {
                    lengthMenu: "Show _MENU_ entries",
                    search: "Search: ",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                }
            });
        });
    </script>
</body>

</html>
