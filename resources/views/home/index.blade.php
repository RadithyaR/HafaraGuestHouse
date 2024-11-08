<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('home.css')
</head>

<body>
    <!-- Header Section Begin -->
    @include('home.header')
    <!-- Header End -->

    <!-- Hero Section Begin -->
    @include('home.slider')
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    @include('home.about')
    <!-- About Us Section End -->

    <!-- Services Section End -->
    @include('home.services')
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section">
      <div class="container-fluid">
          <div class="hp-room-items">
              <div class="row">
    @foreach ($room as $rooms)
                  <div class="col-lg-3 col-md-6 mb-3">
                      <div class="hp-room-item set-bg" data-setbg="room/{{$rooms->image}}">
                          <div class="hr-text">
                              <h3>{{$rooms->name}}</h3>
                              <h2>Rp{{$rooms->price}}<span>/Pernight</span></h2>
                              <table>
                                  <tbody>
                                      <tr>
                                          <td class="r-o">Capacity:</td>
                                          <td>Max persion 5</td>
                                      </tr>
                                      <tr>
                                          <td class="r-o">Services:</td>
                                          <td>{!!Str::limit($rooms->facility, 100)!!}</td>
                                      </tr>
                                  </tbody>
                              </table>
                              <a href="{{url('room_details', $rooms->id)}}" class="primary-btn">More Details</a>
                          </div>
                      </div>
                  </div>
    @endforeach 
              </div>
          </div>
      </div>
  </section>
  <p></p>
    <!-- Home Room Section End -->

    <!-- Footer Section Begin -->
    @include('home.footer')
    <!-- Footer Section End -->

</body>

</html>