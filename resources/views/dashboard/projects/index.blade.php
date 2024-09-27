@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                <h4 class="card-title">Projects</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endSection

@section('script')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function(){
            var project_id = null;
           setTimeout(() => {
                $('.change_project_status').editable({
                    mode: "inline",
                    showbuttons: false,
                    source: [
                        {value: 'not_started', text: 'Not Started'},
                        {value: 'in_progress', text: 'In Progress'},
                        {value: 'completed', text: 'Completed'},
                        {value: 'on_hold', text: 'On Hold'}
                    ],
                    url: function(params) {
                        var data = {
                            status: params.value,
                            id: $(this).data('pk'),
                            '_token': "{{ csrf_token() }}"
                        };
                        var $element = $(this);

                        return $.ajax({
                            url: "{{ route('project.change.status') }}",
                            type: 'POST',
                            data: data,
                            success: function(response) {
                                if(response.status == 'success'){
                                    $element.removeClass('not-started-tag in-progress-tag complete-tag on-hold-tag');
                
                                    // Add the class based on the new status
                                    switch(params.value) {
                                        case 'not_started':
                                            $element.addClass('not-started-tag');
                                            break;
                                        case 'in_progress':
                                            $element.addClass('in-progress-tag');
                                            break;
                                        case 'completed':
                                            $element.addClass('complete-tag');
                                            break;
                                        case 'on_hold':
                                            $element.addClass('on-hold-tag');
                                            break;
                                    }
                                }else{
                                    toastr.error(response.message);
                                    $('#projects-table').DataTable().ajax.reload();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Failed to update status');
                            }
                        });
                    }
                });
           }, 4000);
           $(document).on('click', '.add_pro_assi_btn', function(e) {
            e.stopPropagation();
            project_id = $(this).data('id');
            var type = $(this).data('type');
            var _this = $(this);
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
                                                html += '<li class="assign_user" data-id="'+user.id+'" data-project-id="'+project_id+'"><img src="'+user.avatar+'" alt="'+user.name+'"><p class="m-0">'+user.name+'</p><small>('+user.role.name+')</small></li>';
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
                project_id = null;
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
                            id: project_id,
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
                                html += '<li class="assign_user" data-id="'+user.id+'" data-project-id="'+project_id+'"><img src="'+user.avatar+'" alt="'+user.name+'" ><p class="m-0">'+user.name+'</p><small>('+user.role.name+')</small></li>';
                            });
                            _this.closest('.all_assignies').find('.custom-dropdown-list').html(html);
                        }
                    });
                }, 300);
            });

            $(document).on('click','.assign_user',function(){
                var _this = $(this);
                $.ajax({
                    url:"{{ route('project.add.assignees') }}",
                    type:"POST",
                    data: {
                        project_id: $(this).data('project-id'),
                        user_id: $(this).data('id'),
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
            $(document).on('click', '.delete_project', function() {
                var id = $(this).data('id');
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('project.destroy', ':id') }}".replace(':id', id),  
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id 
                            },
                            success: function(response) {
                                if(response.status == 'success'){
                                    $('#projects-table_wrapper').DataTable().ajax.reload();
                                    intTooltip();
                                    toastr.success(response.message);
                                }
                                if(response.status == 'error'){
                                    toastr.error(response.message);
                                }
                            },
                            error: function(xhr) {
                                swal("Oops!", "Something went wrong. Please try again later.", "error");
                            }
                        });
                    }
                })
            });


        });
    </script>
@endsection