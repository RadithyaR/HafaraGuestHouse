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
                        <h1 class="h3 mb-0 text-gray-800">Message</h1>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="th_deg">Customer Name</th>
                                            <th class="th_deg">Email</th>
                                            <th class="th_deg">Phone</th>
                                            <th class="th_deg">Message</th>    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($message as $messages )
                                        
                                    
                                    <tr>
                                        <td>{{$messages->name}}</td>
                                        <td>{{$messages->email}}</td>
                                        <td>{{$messages->phone}}</td>
                                        <td>{{$messages->message}}</td>
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
            $('#table1').DataTable({
                responsive: true,
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
