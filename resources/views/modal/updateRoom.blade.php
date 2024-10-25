@foreach ($room as $rooms)
<!-- Modal for updating room -->
<div class="modal fade" id="updateRoomModal{{$rooms->id}}" tabindex="-1" aria-labelledby="updateRoomModalLabel{{$rooms->id}}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateRoomModalLabel{{$rooms->id}}">Update Room {{$rooms->room_number}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url('edit_room', $rooms->id)}}" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Room Number</label>
                <input type="text" class="form-control" name="room_number" value="{{$rooms->room_number}}" required>
            </div>
            <div class="mb-3">
                <label>Room Type</label>
                <select class="form-select" name="roomType_id" required>
                    @foreach($type as $tipe)
                    <option value="{{$tipe->id}}" {{$rooms->roomType_id == $tipe->id ? 'selected' : ''}}>{{$tipe->name}}</option>
                    @endforeach
                </select>
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
