<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.css')

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
        @include('home.header')
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
    <div class="our_room">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Pending Payment</h2>
               </div>
            </div>
         </div>
    
        @if($bookings->isEmpty())
            <p>Anda belum melakukan booking.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Lama Menginap</th>
                        <th>Total Harga</th>
                        <th>Biaya DP</th>
                        <th>Status</th>
                        <th>Dipesan Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->user->name}}</td>
                            <td>{{ $booking->user->email }}</td>
                            <td>{{ $booking->user->phone }}</td>
                            <td>{{ $booking->start_date }}</td>
                            <td>{{ $booking->end_date }}</td>
                            <td>{{ $booking->stay }} hari</td>
                            <td>Rp{{ $booking->total }}</td>
                            <td>Rp{{ $booking->deposit }}</td>
                            <td>{{ $booking->status }}</td>
                            <td>{{ $booking->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                @if($booking->status == 'pending')
                                    <a class="btn btn-info" href="{{ route('pay-now', $booking->id) }}">Pay Now</a>
                                @elseif($booking->status == 'accepted')
                                    <span class="badge bg-success">Paid</span>
                                @elseif($booking->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
      <!-- end contact -->
      <!--  footer -->
      @include('home.footer')

      <script type="text/javascript">
         $(window).scroll(function() {
         sessionStorage.scrollTop = $(this).scrollTop();
         });

         $(document).ready(function() {
         if (sessionStorage.scrollTop != "undefined") {
            $(window).scrollTop(sessionStorage.scrollTop);
         }
         });
      </script>
      

   </body>
</html>