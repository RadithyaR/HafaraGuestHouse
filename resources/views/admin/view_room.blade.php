<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  <body>
    <!-- Sidebar Navigation start-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 no-margin-bottom">Rooms</h2>
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">+ Add Room</button>
                </div>
                @include('modal.addRoom')
            </div>
        </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Price</th>
                            <th>Capacity</th>
                            <th>Facility</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($room as $rooms)
                        <tr>
                            <td>{{$rooms->room_number}}</td>
                            <td>{{$rooms->roomTypes->name}}</td>
                            <td>Rp{{$rooms->roomTypes->price}}</td>
                            <td>{{$rooms->roomTypes->capacity}} orang</td>
                            <td>{!!Str::limit($rooms->roomTypes->facility, 150, '...')!!}</td>
                            <td>{{$rooms->status}}</td>
                            <td>
                                <img width="70px" src="room/{{$rooms->roomTypes->image}}" alt="">
                            </td>
                            <td>
                                <a onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger" href="{{url('delete_room', $rooms->id)}}">Delete</a>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateRoomModal{{$rooms->id}}">Update</button>
                                @include('modal.updateRoom')                     
                            </td>
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
  </body>
</html>