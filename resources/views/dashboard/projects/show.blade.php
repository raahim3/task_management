@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">                               
                <h4 class="card-title">Project Overview</h4>
                @if (auth()->user()->hasPermission('task_create'))
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#createTask"><i class="icon-plus"></i> Task</a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                   {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <form action="{{ route('task.store') }}" method="post" id="create_task_form">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required placeholder="Enter Task Title">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="priority">Priority</label>
                            <select name="priority" id="priority" class="form-control">
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="statusa">Status</label>
                            <select name="status" id="statusa" class="form-control">
                                <option value="todo">Todo</option>
                                <option value="in_progress">In Progress</option>
                                <option value="review">Review</option>
                                <option value="done">Done</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="due_date">Due Date</label>
                            <input type="date" name="due_date" id="due_date" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="assignees">Assignees</label>
                            <select name="assignees[]" id="assignees" class="form-control select2" multiple="multiple">
                                @foreach ($assignees as $assignee)
                                    <option value="{{ $assignee->id }}">{{ $assignee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control summernote" cols="30" rows="10"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="createTaskBtn" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endSection
@section('script')
    {{ $dataTable->scripts() }}
    <script>
        var task_id = null;
        $(document).ready(function() {
            setTimeout(() => {
                $('.change_task_priority').editable({
                    mode: "inline",
                    showbuttons: false,
                    source: [
                        {value: 'low', text: 'Low'},
                        {value: 'medium', text: 'Medium'},
                        {value: 'high', text: 'High'},
                        {value: 'urgent', text: 'Urgent'}
                    ],
                    url: function(params) {
                        var data = {
                            priority: params.value,
                            id: $(this).data('pk'),
                            '_token': "{{ csrf_token() }}"
                        };
                        var $element = $(this);

                        return $.ajax({
                            url: "{{ route('task.change.priority') }}",
                            type: 'POST',
                            data: data,
                            success: function(response) {
                                $element.removeClass('bg-danger bg-warning bg-success');
                
                                    // Add the class based on the new status
                                    switch(params.value) {
                                        case 'low':
                                            $element.addClass('bg-success');
                                            break;
                                        case 'medium':
                                            $element.addClass('bg-warning');
                                            break;
                                        case 'high':
                                        case 'urgent':
                                            $element.addClass('bg-danger');
                                            break;
                                    }
                            },
                            error: function(xhr, status, error) {
                                console.error('Failed to update status');
                            }
                        });
                    }
                });
                $('.change_task_status').editable({
                    mode: "inline",
                    showbuttons: false,
                    source: [
                        {value: 'todo', text: 'Todo'},
                        {value: 'in_progress', text: 'In Progress'},
                        {value: 'review', text: 'Review'},
                        {value: 'done', text: 'Done'}
                    ],
                    url: function(params) {
                        var data = {
                            status: params.value,
                            id: $(this).data('pk'),
                            '_token': "{{ csrf_token() }}"
                        };
                        var $element = $(this);

                        return $.ajax({
                            url: "{{ route('task.change.status') }}",
                            type: 'POST',
                            data: data,
                            success: function(response) {
                                $element.removeClass('task_priority_done task_priority_in_progress task_priority_review task_priority_todo');
                                    switch(params.value) {
                                        case 'todo':
                                            $element.addClass('task_priority_todo');
                                            break;
                                        case 'in_progress':
                                            $element.addClass('task_priority_in_progress');
                                            break;
                                        case 'review':
                                            $element.addClass('task_priority_review');
                                            break;
                                        case 'done':
                                            $element.addClass('task_priority_done');
                                            break;
                                    }
                            },
                            error: function(xhr, status, error) {
                                console.error('Failed to update status');
                            }
                        });
                    }
                });
           }, 4000);
            $('#create_task_form').submit(function(e){
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var formData = new FormData(form[0]);
                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function(){
                        $('#createTaskBtn').prop('disabled',true).text('Creating...');
                    },
                    success: function(data){
                        if(data.status == 'success'){
                            $('#createTask').modal('hide');
                            $('#create_task_form')[0].reset();
                            $('#projecttask-table').DataTable().ajax.reload();
                        }
                        if(data.status == 'error'){
                            toastr.error(data.message);
                        }
                    },
                    complete: function(){
                        $('#createTaskBtn').prop('disabled',false).text('Create');
                    }
                });
            });
            $(document).on('click', '.add_task_assi_btn', function(e) {
            e.stopPropagation();
            task_id = $(this).data('id');
            var _this = $(this);
            var type = $(this).data('type');
                $.ajax({
                    url:"{{ route('get.assignees') }}",
                    type:"POST",
                    data: {
                        id: $(this).data('id'),
                        type:type,
                        '_token': "{{ csrf_token() }}"
                    },
                    success:function(data){
                        var html = `<div class="all_assignies">
                                        <div class="search-box">
                                            <i class="icon-magnifier"></i>
                                            <input type="text" class="form-control" placeholder="Search" id="search_assignees">
                                        </div>
                                        <p class="my-2"><strong>All Members</strong></p>
                                        <ul class="custom-dropdown-list">`;
                                            data.users.forEach(function(user) {
                                                if(user.avatar != null){
                                                    user.avatar = asset_url+'avatars/'+user.avatar;
                                                }else{
                                                    user.avatar = asset_url+'default-avatar.webp';
                                                }
                                                html += '<li class="assign_user_task" data-id="'+user.id+'" data-task-id="'+task_id+'"><img src="'+user.avatar+'" alt="'+user.name+'"><p class="m-0">'+user.name+'</p><small>('+user.role.name+')</small></li>';
                                            })
                                        html += `</ul>
                                    </div>`;

                        _this.append(html);
                        $('.all_assignies').not(_this.find('.all_assignies')).remove();
                        _this.find('.all_assignies').toggle();
                    }
                });
            });
            $(document).on('click', '.all_assignies', function(e) {
                e.stopPropagation(); 
            });

            $(document).on('click', function() {
                $('.all_assignies').remove();
                task_id = null;
            });
            let debounceTimer;
            $(document).on('keyup', '#search_assignees', function() {
                clearTimeout(debounceTimer);
                var value = $(this).val();
                var _this = $(this);

                debounceTimer = setTimeout(function() {
                    $.ajax({
                        url: "{{ route('search.assignees') }}",
                        type: "POST",
                        data: {
                            id: task_id,
                            value: value,
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            var html = '';
                            data.users.forEach(function(user) {
                                if(user.avatar != null){
                                    user.avatar = asset_url+'avatars/'+user.avatar;
                                }else{
                                    user.avatar = asset_url+'default-avatar.webp';
                                }
                                html += '<li class="assign_user_task" data-id="'+user.id+'" data-task-id="'+task_id+'"><img src="'+user.avatar+'" alt="'+user.name+'" ><p class="m-0">'+user.name+'</p><small>('+user.role.name+')</small></li>';
                            });
                            _this.closest('.all_assignies').find('.custom-dropdown-list').html(html);
                        }
                    });
                }, 300);
            });
            $(document).on('click','.assign_user_task',function(){
                var _this = $(this);
                $.ajax({
                    url:"{{ route('task.add.assignees') }}",
                    type:"POST",
                    data: {
                        task_id: $(this).data('task-id'),
                        user_id: $(this).data('id'),
                        project_id : "{{ $project->id }}",
                        '_token': "{{ csrf_token() }}"
                    },
                    success:function(data){
                        if(data.status == 'error'){
                            _this.addClass('project_pass_bg');
                        }
                        if(data.status == 'success'){
                            var avatar = asset_url+'default-avatar.webp';
                            if(data.user.avatar != null){
                                avatar = asset_url+'avatars/'+data.user.avatar;
                            }
                            _this.addClass('light-success');
                            var html = `<a href="#" class="assignee" data-toggle="tooltip" data-placement="top" title="${data.user.name}">
                                            <img src="${avatar}" 
                                                alt="" class="img-fluid rounded-circle">
                                        </a>`;
                            _this.parent().parent().parent().parent().prepend(html);
                        }
                    }
                });
            });
        });
    </script>
@endsection
