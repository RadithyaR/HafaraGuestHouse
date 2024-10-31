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
                        <h1 class="h3 mb-0 text-gray-800">Customer</h1>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $users)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $users->name }}</td>
                                                <td>{{ $users->email }}</td>
                                                <td>{{ $users->phone }}</td>
                                                <td>
                                                    <button class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#customerDetailModal"
                                                        onclick="showCustomerDetails('{{ $users->name }}', '{{ $users->email }}', '{{ $users->phone }}','{{ $users->blob_path }}', '{{ $users->nik }}', '{{ $users->alamat }}')"><i
                                                            class="bi bi-info-circle"></i></button>

                                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#customerEditModal"
                                                        onclick="showCustomerEdits('{{ $users->name }}', '{{ $users->email }}', '{{ $users->phone }}', {{ $users->id }}, '{{ $users->nik }}' , '{{ $users->alamat }}')"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                </td>
                                                <!-- Modal -->
                                                <div class="modal fade" id="customerDetailModal" tabindex="-1"
                                                    aria-labelledby="customerDetailModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="customerDetailModalLabel">
                                                                    Customer
                                                                    Details</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Name: </strong><span
                                                                        id="modalCustomerName"></span></p>
                                                                <p><strong>Email: </strong><span
                                                                        id="modalCustomerEmail"></span></p>
                                                                <p><strong>Phone: </strong><span
                                                                        id="modalCustomerPhone"></span></p>
                                                                <!-- Link untuk file attachment -->
                                                                <p><strong>Attachment: </strong>
                                                                    <a href="" id="modalCustomerAttachment"
                                                                        target="_blank">View File</a>
                                                                </p>
                                                                <p>
                                                                    <strong>NIK: </strong><span
                                                                        id="modalCustomerNIK"></span>
                                                                </p>
                                                                <p>
                                                                    <strong>Alamat: </strong><span
                                                                        id="modalCustomerAlamat"></span>
                                                                </p>
                                                                <!-- You can add more fields here if needed -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="customerEditModal" tabindex="-1"
                                                    aria-labelledby="customerEditModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="customerEditModalLabel">
                                                                    Customer Edit
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('update_user') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="id">
                                                                    <div class="mb-3">
                                                                        <label for="modalCustomerNameEdit"
                                                                            class="form-label"><strong>Name</strong></label>
                                                                        <input type="text" class="form-control"
                                                                            id="modalCustomerNameEdit"
                                                                            name="customer_name" readonly>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="modalCustomerEmailEdit"
                                                                            class="form-label"><strong>Email</strong></label>
                                                                        <input type="email" class="form-control"
                                                                            id="modalCustomerEmailEdit"
                                                                            name="customer_email" readonly>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="modalCustomerPhoneEdit"
                                                                            class="form-label"><strong>Phone</strong></label>
                                                                        <input type="text" class="form-control"
                                                                            id="modalCustomerPhoneEdit"
                                                                            name="customer_phone" readonly>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="modalCustomerNIKEdit"
                                                                            class="form-label"><strong>NIK</strong></label>
                                                                        <input type="text" class="form-control"
                                                                            id="modalCustomerNIKEdit"
                                                                            name="customer_nik" readonly>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="modalCustomerAlamatEdit"
                                                                            class="form-label"><strong>Alamat</strong></label>
                                                                        <input type="text" class="form-control"
                                                                            id="modalCustomerAlamatEdit"
                                                                            name="customer_alamat" readonly>
                                                                    </div>
                                                                    
                                                                    <div class="mb-3">
                                                                        <label for="modalCustomerFileEdit"
                                                                            class="form-label"><strong>Upload
                                                                                File</strong></label>
                                                                        <input class="form-control" type="file"
                                                                            id="modalCustomerFileEdit"
                                                                            name="customer_file" required>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save
                                                                            Changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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
                    [0, 'asc']
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
