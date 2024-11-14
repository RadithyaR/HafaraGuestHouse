<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
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
                        <h1 class="h3 mb-0 text-gray-800">View Room Type</h1>
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal">+ Add Room Type</button>
                    </div>
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @include('modal.addRoomType')
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Room Name</th>
                                            <th>Price</th>
                                            <th>Capacity Adults</th>
                                            <th>Capacity Kids</th>
                                            <th>Facility</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($type as $types)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$types->name}}</td>
                                            <td>Rp{{$types->price}}</td>
                                            <td>{{$types->capacity}} orang</td>
                                            <td>{{$types->capacity_kids}} orang</td>
                                            <td>{!!Str::limit($types->facility, 150, '...')!!}</td>
                                            <td>
                                                <img width="70px" src="room/{{$types->image}}" alt="">
                                            </td>
                                            <td>
                                                <a onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger" href="{{url('delete_roomType', $types->id)}}"><i class="bi bi-trash3"></i></a>
                                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateRoomTypeModal{{$types->id}}"><i class="bi bi-pencil-square"></i></button> 
                                                @include('modal.updateRoomType')                   
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
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

        @if(Session::has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ Session::get("success") }}',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif
    </script>
</body>

</html>
