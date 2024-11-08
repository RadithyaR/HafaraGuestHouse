<!-- Modal for updating room type -->
@foreach ($type as $types)
<div class="modal fade" id="updateRoomTypeModal{{$types->id}}" tabindex="-1" aria-labelledby="updateRoomTypeModalLabel{{$types->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateRoomTypeModalLabel{{$types->id}}">Update Room Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('roomTypes.edit', $types->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Type Name</label>
                        <input type="text" class="form-control" name="name" value="{{$types->name}}" required>
                    </div>
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" value="{{$types->price}}" required>
                    </div>
                    <div class="mb-3">
                        <label>Capacity Adults</label>
                        <input type="number" class="form-control" name="capacity" value="{{$types->capacity}}" required>
                    </div>
                    <div class="mb-3">
                        <label>Capacity Kids</label>
                        <input type="number" class="form-control" name="capacity_kids" value="{{$types->capacity_kids}}" required>
                    </div>
                    <div class="mb-3">
                        <label>Facility</label>
                        <input type="text" class="form-control" name="facility" value="{{$types->facility}}" required>
                    </div>
                    <div class="mb-3">
                        <label>Current Image</label><br>
                        <img width="100px" src="/room/{{$types->image}}" alt="">
                    </div>
                    <div class="mb-3">
                        <label>Upload New Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
