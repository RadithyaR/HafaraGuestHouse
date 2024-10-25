<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero-text">
                    <h1>Selamat Datang !</h1>
                    <p>Here are the best hotel booking sites, including recommendations for international
                        travel and for finding low-priced hotel rooms.</p>
                    <a href="#" class="primary-btn">Discover Now</a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                <div class="booking-form">
                    <h3>Book Your Room</h3>
                    <form class="book_now" action="{{route('check-availability')}}" method="post">
                        @csrf
                        <div class="check-date">
                            <label for="date-in">Check In:</label>
                            <input class="form-control" placeholder="dd/mm/yyyy" type="date" name="checkin_date" required>
                        </div>
                        <div class="check-date">
                            <label for="date-out">Check Out:</label>
                            <input class="form-control" placeholder="dd/mm/yyyy" type="date" name="checkout_date" required>
                        </div>
                        <button type="submit">Check Availability</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="img/hero/hero-1.jpg"></div>
        <div class="hs-item set-bg" data-setbg="img/hero/hero-2.jpg"></div>
        <div class="hs-item set-bg" data-setbg="img/hero/hero-3.jpg"></div>
    </div>
</section>