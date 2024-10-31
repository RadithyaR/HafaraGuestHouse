<!-- Bootstrap core JavaScript-->
<script src="admin/vendor/jquery/jquery.min.js"></script>
<script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="adminvendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="admin/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="admin/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="admin/js/demo/chart-area-demo.js"></script>
<script src="admin/js/demo/chart-pie-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function showCustomerDetails(name, email, phone, attachment, nik, alamat) {
    document.getElementById('modalCustomerName').innerText = name;
    document.getElementById('modalCustomerEmail').innerText = email;
    document.getElementById('modalCustomerPhone').innerText = phone;
    document.getElementById('modalCustomerAttachment').href = attachment;
    document.getElementById('modalCustomerNIK').innerText = nik;
    document.getElementById('modalCustomerAlamat').innerText = alamat;
}

function showCustomerEdits(name, email, phone, id, nik, alamat) {
    document.getElementById('modalCustomerNameEdit').value = name;
    document.getElementById('modalCustomerEmailEdit').value = email;
    document.getElementById('modalCustomerPhoneEdit').value = phone;
    document.querySelector('input[name="id"]').value = id;
    document.getElementById('modalCustomerNIKEdit').value = nik;
    document.getElementById('modalCustomerAlamatEdit').value = alamat;
}
</script>

