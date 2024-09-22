@extends('layouts.admin')

@section('admin')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4>{{ $role->name }}</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                    <li class="breadcrumb-item active">{{ $role->name }}</li>
                </ol>
            </div>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('admin.users.create' , $role->id) }}" class="btn btn-primary float-end"><i class="mdi mdi-plus me-1"></i> Add New</a>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

</div>

@endSection

@section('script')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function(){
            $(document).on('click','.block_team_member',function() {
                var id = $(this).data('id');
                var _this = $(this);
                $.ajax({
                    url: "{{ route('admin.users.status', '') }}/" + id,
                    type: 'GET',
                    success: function(data) {
                        if(data.status == 'success'){
                            $('#user-table').DataTable().ajax.reload();
                        }
                    }
                });
            });
        });
    </script>
@endsection