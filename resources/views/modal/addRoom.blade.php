<!-- Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addRoomModalLabel">Tambah Room</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{url('add_room')}}" method="Post" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                  <label>Room Number</label>
                  <input type="text" class="form-control" name="room_number" required>
              </div>
              <div class="mb-3">
                  <label for="">Room Type</label>
                  <select class="form-select" id="roomType_id" name="roomType_id" required>
                      @foreach($type as $tipe)
                      <option value="{{$tipe->id}}">{{$tipe->name}}</option>
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
  