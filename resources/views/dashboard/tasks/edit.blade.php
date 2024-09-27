    @csrf
    @method('PUT')
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
            <input type="hidden" name="project_id" value="{{ $task->project->id }}">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required value="{{ $task->name }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="priority">Priority</label>
                    <select name="priority" id="priority" class="form-control">
                        <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                        <option value="urgent" {{ $task->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="statusa">Status</label>
                    <select name="status" id="statusa" class="form-control">
                        <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
                        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="review" {{ $task->status == 'review' ? 'selected' : '' }}>Review</option>
                        <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="due_date">Due Date</label>
                    <input type="date" name="due_date" id="due_date" class="form-control" required value="{{ $task->due_date }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="assignees">Assignees</label>
                    <select name="assignees[]" id="assignees" class="form-control select2" multiple="multiple">
                        @foreach ($assignees as $assignee)
                            <option value="{{ $assignee->id }}" {{ in_array($assignee->id, $assignee_ids ) ? 'selected' : '' }} >{{ $assignee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control summernote" cols="30" rows="10">{{ $task->description }}</textarea>
                </div>
            </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" id="updateTaskBtn" class="btn btn-primary">Update</button>
    </div>
</form>