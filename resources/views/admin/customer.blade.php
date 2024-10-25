<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Sidebar Navigation start-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Customer</h2>
            </div>
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
                                            onclick="showCustomerDetails('{{ $users->name }}', '{{ $users->email }}', '{{ $users->phone }}','{{ $users->blob_path }}')">Detail</button>

                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#customerEditModal"
                                            onclick="showCustomerEdits('{{ $users->name }}', '{{ $users->email }}', '{{ $users->phone }}', {{ $users->id }})">Edit</button>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="customerDetailModal" tabindex="-1"
                                        aria-labelledby="customerDetailModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="customerDetailModalLabel">Customer
                                                        Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Name: </strong><span id="modalCustomerName"></span></p>
                                                    <p><strong>Email: </strong><span id="modalCustomerEmail"></span></p>
                                                    <p><strong>Phone: </strong><span id="modalCustomerPhone"></span></p>
                                                    <!-- Link untuk file attachment -->
                                                    <p><strong>Attachment: </strong>
                                                        <a href="" id="modalCustomerAttachment"
                                                            target="_blank">View File</a>
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
                                                    <h5 class="modal-title" id="customerEditModalLabel">Customer Edit
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('update_user') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id">
                                                        <div class="mb-3">
                                                            <label for="modalCustomerNameEdit"
                                                                class="form-label"><strong>Name</strong></label>
                                                            <input type="text" class="form-control"
                                                                id="modalCustomerNameEdit" name="customer_name"
                                                                required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="modalCustomerEmailEdit"
                                                                class="form-label"><strong>Email</strong></label>
                                                            <input type="email" class="form-control"
                                                                id="modalCustomerEmailEdit" name="customer_email"
                                                                required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="modalCustomerPhoneEdit"
                                                                class="form-label"><strong>Phone</strong></label>
                                                            <input type="text" class="form-control"
                                                                id="modalCustomerPhoneEdit" name="customer_phone"
                                                                required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="modalCustomerFileEdit"
                                                                class="form-label"><strong>Upload File</strong></label>
                                                            <input class="form-control" type="file"
                                                                id="modalCustomerFileEdit" name="customer_file"
                                                                required>
                                                        </div>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
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
    <!-- footer-->
    @include('admin.footer')

    <script>
        function showCustomerDetails(name, email, phone, attachment) {
            // Isi data ke modal
            document.getElementById('modalCustomerName').innerText = name;
            document.getElementById('modalCustomerEmail').innerText = email;
            document.getElementById('modalCustomerPhone').innerText = phone;
            const attachmentLink = document.getElementById('modalCustomerAttachment');
            if (attachment) {
                attachmentLink.href = attachment; // Menetapkan URL file
                attachmentLink.innerText = "View File"; // Menampilkan teks jika file ada
                attachmentLink.style.display = "inline"; // Pastikan link ditampilkan
            } else {
                attachmentLink.href = "#"; // Atur href ke # jika tidak ada file
                attachmentLink.innerText = "No file available"; // Tampilkan pesan jika tidak ada file
                attachmentLink.style.display = "inline"; // Pastikan teks tetap muncul
            }
        }

        function showCustomerEdits(name, email, phone, id) {
            // Isi data ke modal
            document.getElementById('modalCustomerNameEdit').value = name;
            document.getElementById('modalCustomerEmailEdit').value = email;
            document.getElementById('modalCustomerPhoneEdit').value = phone;
            document.querySelector('input[name="id"]').value = id;
        }
    </script>
</body>

</html>
