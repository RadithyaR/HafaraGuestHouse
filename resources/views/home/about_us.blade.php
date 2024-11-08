<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.css')
   </head>
   <!-- body -->
   <body>
    
      @include('home.header')
    <!-- end header inner -->

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="breadcrumb-text">
                      <h2>Tentang Kami</h2>
                      <div class="bt-option">
                          <a href="{{route('home')}}">Beranda</a>
                          <span>Tentang Kami</span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Breadcrumb Section End -->

   <!-- About Us Page Section Begin -->
    <section class="aboutus-page-section spad">
        <div class="container">
            <div class="about-page-text">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ap-title">
                            <h2>Selamat Datang di Hafara</h2>
                            <p>Dengan akses mudah ke berbagai destinasi wisata, pusat perbelanjaan, dan kuliner khas Minang, 
                               Hafara Guesthouse Syariah menjadi pilihan tepat bagi wisatawan yang mencari penginapan berkualitas dengan harga terjangkau. 
                               Kami berkomitmen memberikan kenyamanan dan ketenangan bagi setiap tamu,
                               dengan fasilitas yang bersih dan pelayanan ramah yang sesuai dengan nilai-nilai Islam.</p>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                        <ul class="ap-services">
                            <li><i class="icon_check"></i> Berada di Pusat Kota</li>
                            <li><i class="icon_check"></i> Harga yang terjangkau</li>
                            <li><i class="icon_check"></i> Berbasis Syariah</li>
                            <li><i class="icon_check"></i> Free Wifi.</li>
                            <li><i class="icon_check"></i> Dekat RSUP M.Djamil</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Page Section End -->

    <!-- Gallery Section Begin -->
    <section class="gallery-section spad">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="section-title">
                      <span>Our Gallery</span>
                      <h2>Discover Our Work</h2>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-6">
                  <div class="gallery-item set-bg" data-setbg="img/gallery/gallery1.jpg">
                      <div class="gi-text">
                          <h3>Hafara</h3>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="gallery-item set-bg" data-setbg="img/gallery/gallery3.jpg">
                              <div class="gi-text">
                                  <h3>Hafara</h3>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="gallery-item set-bg" data-setbg="img/gallery/gallery4.jpg">
                              <div class="gi-text">
                                  <h3>Hafara</h3>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="gallery-item large-item set-bg" data-setbg="img/gallery/gallery2.jpg">
                      <div class="gi-text">
                          <h3>Hafara</h3>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Gallery Section End -->
  
    <!--  footer -->
    @include('home.footer')
   </body>
</html>