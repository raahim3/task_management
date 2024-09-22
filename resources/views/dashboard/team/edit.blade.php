<div class="modal fade" id="editTeamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="post" id="update_team_form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Team Member</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_team_id" name="id">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="edit_name">Profile <small>(Optional)</small></label>
                        <input type="file" class="form-control dropify" name="profile" id="edit_profile">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="edit_name">Name</label>
                        <input type="text" class="form-control" name="name" id="edit_name" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="edit_email">Email</label>
                        <input type="email" class="form-control" name="email" id="edit_email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="edit_role">Role</label>
                        <select class="form-control" name="role" id="edit_role" required>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" autocomplete="new-password" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="updateTeamBtn" class="btn btn-primary">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>