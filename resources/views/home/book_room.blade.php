<!DOCTYPE html>
<html lang="en">
   <head>
    <base href="/public">
      @include('home.css')
      

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
                      <h2>Booking Ruangan</h2>
                      <div class="bt-option">
                          <a href="{{route('home')}}">Beranda</a>
                          <span>Book Room</span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Breadcrumb Section End -->

  <section class="room-details-section spad d-flex justify-content-center align-items-center">
   <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div id="serv_hover" class="room">
                        <div style="padding: 20px" class="room_img">
                            <figure><img style="height: 300px; width: 800px;" src="/room/{{ $roomType->image }}"
                                    alt="#" /></figure>
                        </div>
                        <div class="bed_room">
                            <h3>{{ $roomType->name }}</h3>
                            <h4>Fasilitas : {!!Str::limit($roomType->facility, 100)!!}</h4>
                            <h5>Kapasitas (Dewasa): {{ $roomType->capacity }}</h5>
                            <h5>Kapasitas (Anak): {{ $roomType->capacity_kids }}</h5>
                            <h4>price : {{ $roomType->price }}</h4>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h4 style="font-size: 20px">Booking for room from {{ $checkin_date }} to {{ $checkout_date }}</h4>

                    <div>

                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-bs-dismiss="alert">x</button>
                                {{ session()->get('message') }}
                            </div>
                        @endif

                    </div>

                    @if ($errors)
                        @foreach ($errors->all() as $errors)
                            <li style="color: red;">
                                {{ $errors }}
                            </li>
                        @endforeach
                    @endif

                    <form action="{{ url('add_to_cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="roomType_id" value="{{ $roomType->id }}">
                        <input type="hidden" name="roomType_id" value="{{ $roomType->id }}">
                        <input type="hidden" name="checkin_date" value="{{ $checkin_date }}">
                        <input type="hidden" name="checkout_date" value="{{ $checkout_date }}">

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $user->phone }}" required>
                        </div>
                        <div class="form-group">
                            <label for="room_quantity">Jumlah kamar:</label>
                            <select class="form-control mb-2" id="jumlah_kamar" name="jumlah_kamar" required>
                                @for ($i = 1; $i <= $roomType->rooms_count; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="additionalBed" value="1"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Additional Bed
                            </label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="additionalBed" value="0"
                                id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                No Additional Bed
                            </label>
                        </div>
                        <div class="form-group">
                            <span class="badge rounded-pill bg-light text-dark">If you want to add additional bed, you
                                will be charged Rp 50,000</span>
                        </div>

                        <!-- More booking details can be added here -->

                        <button type="submit" class="btn btn-primary mt-1">Add to Cart</button>
                    </form>


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

</html>