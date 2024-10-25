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
                    <h2 class="h5 no-margin-bottom">Room Types</h2>
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal">+ Add Room Type</button>
                </div>
                @include('modal.addRoomType')    
            </div>
        </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Room Name</th>
                            <th>Price</th>
                            <th>Capacity</th>
                            <th>Facility</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($type as $types)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$types->name}}</td>
                            <td>Rp{{$types->price}}</td>
                            <td>{{$types->capacity}} orang</td>
                            <td>{!!Str::limit($types->facility, 150, '...')!!}</td>
                            <td>
                                <img width="70px" src="room/{{$types->image}}" alt="">
                            </td>
                            <td>
                                <a onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger" href="{{url('delete_roomType', $types->id)}}">Delete</a>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateRoomTypeModal{{$types->id}}">Update</button> 
                                @include('modal.updateRoomType')                   
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