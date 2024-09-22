@extends('layouts.dashboard ')

@section('content')

<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">                               
                <h4 class="card-title">Team</h4>
                @if(auth()->user()->hasPermission('team_create'))
                    <a href="#" data-toggle="modal" data-target="#createTeamModal" class="btn btn-primary"><i class="icon-plus"></i> Add</a>
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
@include('dashboard.team.create')
@include('dashboard.team.edit')
@endSection

@section('script')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {
            $('#create_team_form').submit(function(e){
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function(){
                        $('#createTeamBtn').prop('disabled',true).text('Saveing...');
                    },
                    success: function(data) {
                        if(data.status == 'success'){
                            $('#createTeamModal').modal('hide');
                            $('#team-table').DataTable().ajax.reload();
                        }
                        if(data.status == 'error'){
                            toastr.error(data.message);
                        }
                    },
                    complete: function(){
                        $('#createTeamBtn').prop('disabled',false).text('Save');
                    }
                });
            });
            $(document).on('click','.edit_btn',function() {
                $('#edit_name').val($(this).data('name'));
                $('#edit_email').val($(this).data('email'));
                $('#edit_role').val($(this).data('role'));
                $('#edit_profile').val($(this).data('profile'));
                $('#edit_team_id').val($(this).data('id'));
                $('#editTeamModal').modal('show');
            });
            $('#update_team_form').submit(function(e){
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                var id = $('#edit_team_id').val();
                $.ajax({
                    url: "{{ route('team.update', '') }}/" + id,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function(){
                        $('#updateTeamBtn').prop('disabled',true).text('Uptading...');
                    },
                    success: function(data) {
                        if(data.status == 'success'){
                            $('#editTeamModal').modal('hide');
                            $('#team-table').DataTable().ajax.reload();
                        }
                    },
                    complete: function(){
                        $('#updateTeamBtn').prop('disabled',false).text('Update');
                    }
                });
            });
            $(document).on('click','.block_team_member',function() {
                var id = $(this).data('id');
                var _this = $(this);
                $.ajax({
                    url: "{{ route('team.status', '') }}/" + id,
                    type: 'GET',
                    success: function(data) {
                        if(data.status == 'success'){
                            $('#team-table').DataTable().ajax.reload();
                        }
                    }
                });
            });
        });
    </script>
@endsection