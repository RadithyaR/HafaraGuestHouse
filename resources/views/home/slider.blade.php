<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero-text">
                    <h1>Selamat Datang di Hafara !</h1>
                    <p>Guesthouse berbasis Syariah yang menyediakan berbagai fasilitas dan harga yang terjangkau</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                <div class="booking-form">
                    <h3>Book Your Room</h3>
                    <p id="date-error" style="color: red; display: none;">Tanggal Check Out tidak boleh lebih awal dari tanggal Check In.</p>
                    <form class="book_now" action="{{route('check-availability')}}" method="post" onsubmit="return validateDates()">
                        @csrf
                        <div class="check-date">
                            <label for="date-in">Check In:</label>
                            <input class="form-control" type="date" name="checkin_date" id="date-in" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                        </div>
                        <div class="check-date">
                            <label for="date-out">Check Out:</label>
                            <input class="form-control" type="date" name="checkout_date" id="date-out" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                        </div>
                        <button type="submit">Check Availability</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="img/hero/hero1.jpg"></div>
        <div class="hs-item set-bg" data-setbg="img/hero/hero2.jpg"></div>
        <div class="hs-item set-bg" data-setbg="img/hero/hero3.jpg"></div>
    </div>
</section>

<script>
    function validateDates() {
        // Ambil nilai tanggal Check In dan Check Out
        const checkInDate = document.getElementById('date-in').value;
        const checkOutDate = document.getElementById('date-out').value;

        // Konversi nilai tanggal ke objek Date
        const checkIn = new Date(checkInDate);
        const checkOut = new Date(checkOutDate);

        // Periksa apakah Check Out lebih awal dari Check In
        if (checkOut < checkIn) {
            // Tampilkan pesan error
            document.getElementById('date-error').style.display = 'block';
            return false; // Mencegah form dikirim
        } else {
            // Sembunyikan pesan error jika valid
            document.getElementById('date-error').style.display = 'none';
            return true; // Lanjutkan pengiriman form
        }
    }
</script>