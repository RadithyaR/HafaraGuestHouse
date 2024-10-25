<!-- Modal -->
<div class="modal fade" id="addRoomTypeModal" tabindex="-1" aria-labelledby="addRoomTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addRoomTypeModalLabel">Add Room Type</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{url('add_roomType')}}" method="Post" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                  <label>Type Name</label>
                  <input type="text" class="form-control" name="name" required>
              </div>
              <div class="mb-3">
                <label>Price</label>
                <input type="text" class="form-control" name="price" required>
            </div><div class="mb-3">
                <label>Facility</label>
                <input type="text" class="form-control" name="facility" required>
            </div><div class="mb-3">
                <label>Capacity</label>
                <input type="number" class="form-control" name="capacity" required>
            </div>
            <div class="mb-3">
              <label for="">Upload Image</label>
              <input type="file" class="form-control" name="image" required>
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
  