<!DOCTYPE html>
<html lang="en">
   <head>
    <base href="/public">
      @include('home.css')
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   </head>
   <!-- body -->
   <body>
        @include('home.header')

   <!-- Breadcrumb Section Begin -->
   <div class="breadcrumb-section">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="breadcrumb-text">
                      <h2>Ruangan Kami</h2>
                      <div class="bt-option">
                          <a href="{{route('home')}}">Beranda</a>
                          <a href='{{route('rooms')}}'>Ruangan</a>
                          <span>Detail Ruangan</span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Breadcrumb Section End -->

  <section class="room-details-section spad d-flex justify-content-center align-items-center">
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-lg-8">
               <div class="room-details-item">
                   <img style="height: 100%; width: 100%; object-fit: cover;" src="/room/{{$room->image}}" alt="#"/>
                   <div class="rd-text">
                       <div class="rd-title">
                           <h3>{{$room->name}}</h3>
                           <div class="rdt-right">    
                              <a href="{{route("home")}}">Booking Now</a>
                           </div>
                       </div>
                       <h2>Rp{{$room->price}}<span>/Pernight</span></h2>
                       <table>
                           <tbody>
                               <tr>
                                   <td class="r-o">Capacity(Adults):</td>
                                   <td>{{$room->capacity}} person</td>
                               </tr>
                               <tr>
                                <td class="r-o">Capacity(Kids):</td>
                                <td>{{$room->capacity_kids}} person</td>
                            </tr>
                               <tr>
                                   <td class="r-o">Services:</td>
                                   <td>{{$room->facility}}</td>
                               </tr>
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
</section>
    
      <!-- end header inner -->
      <!--  footer -->
      @include('home.footer')

      <script type="text/javascript">
        $(function(){
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();

            if(month < 10)
            month = '0' + month.toString();

            if(day < 10)
            day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            $('#startDate').attr('min', maxDate);
            $('#endDate').attr('min', maxDate);
        });
      </script>
        <!--javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
   </body>
</html>