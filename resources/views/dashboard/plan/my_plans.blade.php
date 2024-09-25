@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">                               
                <h4 class="card-title">My Subscriptions</h4>
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
            $(document).on('click','.active_sub',function() {
                 var id = $(this).data('id');
                 swal({
                    title: "Are you sure?",
                    text: "You will be able to revert this plan!",
                    type: "success",
                    showCancelButton: true,
                    cancelButtonClass: 'btn-danger',
                    confirmButtonClass: 'btn-success',
                    confirmButtonText: 'Yes, change it!',
                    closeOnConfirm: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('change.subscription') }}",  
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                plan_id: id 
                            },
                            success: function(response) {
                                swal("Success!", "Your plan has been changed.", "success");
                            },
                            error: function(xhr) {
                                swal("Oops!", "Something went wrong. Please try again later.", "error");
                            }
                        });
                    }
                });


            });
        });
    </script>
@endsection