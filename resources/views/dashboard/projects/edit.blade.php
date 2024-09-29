@csrf
@method('PUT')
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="pro_name">Project Name</label>
            <input type="text" name="name" id="pro_name" value="{{ $project->name }}" class="form-control">
        </div>
        <div class="col-md-6 mt-3">
            <label for="pro_color">Color</label>
            <input type="color" name="color" id="pro_color" value="{{ $project->color }}" class="form-control">
        </div>
        <div class="col-md-6 mt-3">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ $project->start_date }}" class="form-control">
        </div>
        <div class="col-md-6 mt-3">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" value="{{ $project->end_date }}" class="form-control">
        </div>
        <div class="col-md-6 mt-3">
            <label for="pro_status">Status</label>
            <select name="status" id="pro_status" class="form-control">
                <option value="not_started" @if($project->status == 'not_started') selected @endif>Not Started</option>
                <option value="in_progress" @if($project->status == 'in_progress') selected @endif>In Progress</option>
                <option value="completed" @if($project->status == 'completed') selected @endif>Completed</option>
                <option value="on_hold" @if($project->status == 'on_hold') selected @endif>On Hold</option>
            </select>
        </div>
        <div class="col-md-6 mt-3">
            <label for="pro_assignees">Assignees</label>
            <select name="assignees[]" id="pro_assignees" class="form-control" multiple>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ in_array($user->id , $assign_ids) ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 mt-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="description summernote">{!! $project->description !!}</textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" id="updateProjectBtn" class="btn btn-primary">Update</button>
</div>