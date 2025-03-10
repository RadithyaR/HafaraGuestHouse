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
                        <h1 class="h3 mb-0 text-gray-800">User</h1>
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
                                                        onclick="showUserDetails('{{ $users->name }}', '{{ $users->email }}', '{{ $users->phone }}', '{{ $users->role->name }}')"><i
                                                            class="bi bi-info-circle"></i></button>

                                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#customerEditModal"
                                                        onclick="showUserEdits('{{ $users->name }}', '{{ $users->email }}', '{{ $users->phone }}', {{ $users->id }}, '{{ $users->role_id }}')"><i
                                                            class="bi bi-pencil-square"></i></button>

                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#customerDeleteModal"
                                                        onclick="setDeleteUserId({{ $users->id }})">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
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
                                                                <p><strong>Role: </strong><span
                                                                        id="modalCustomerRole"></span></p>
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
                                                                <form action="{{ route('update_role') }}"
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
                                                                        <label
                                                                            class="form-label"><strong>Role</strong></label>
                                                                        <select class="form-control" name="role_id">
                                                                            @foreach ($role as $r)
                                                                                <option value="{{ $r->id }}">
                                                                                    {{ $r->name }}</option>
                                                                            @endforeach
                                                                        </select>
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

                                                <!-- Modal Delete -->
                                                <div class="modal fade" id="customerDeleteModal" tabindex="-1"
                                                    aria-labelledby="customerDeleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="customerDeleteModalLabel">
                                                                    Confirm Delete</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this user?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('delete_user') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="id"
                                                                        id="deleteUserId">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
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
