@extends('layouts.dashboard')
@section('content')
<style>
    #create_project_section{
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100svh;
        background-color: #fff;
        z-index: 100000;
    }
    .back_project{
        position: absolute;
        top: 10px;
        right: 20px;
        z-index: 100001;
        font-size: 30px

    }
    .create_project_card{
        border: none
    }
</style>
    <section id="create_project_section">
        <a href="{{ route('home') }}" wire:navigate class="back_project"><i class="icon-close"></i></a>
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-4">
                <h3 class="card-title text-center">New Project</h3>
                <div class="card create_project_card">
                    <div class="card-body">
                        <form action="{{ route('project.store') }}" method="POST" id="project_form">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="">Project Name</label>
                                    <input type="text" class="form-control" required name="project_name" placeholder="Project Name....">
                                    @error('project_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Color</label>
                                    <input type="color" class="form-control" name="color" required>
                                    @error('color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" required>
                                    @error('start_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">End Date</label>
                                    <input type="date" class="form-control" name="end_date" required >
                                    @error('end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" id="submit" class="btn btn-outline-primary w-100 mt-3">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#project_form').submit(function(e){
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
                        $('#submit').prop('disabled',true).text('Creating...');
                    },
                    success: function(data){
                        if(data.status == 'success'){
                            window.location.href = "{{ route('project.index') }}";
                        }
                        if(data.status == 'error'){
                            toastr.error(data.message);
                        }
                    },
                    complete: function(){
                        $('#submit').prop('disabled',false).text('Create');
                    }
                });
            });
        });
    </script>
@endsection