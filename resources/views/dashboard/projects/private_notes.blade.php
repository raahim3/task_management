@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">                               
                <h4 class="card-title">Project : <a href="javascript:void(0)" class="text-primary">#{{ $project->name }}</a></h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    @include('dashboard.projects.nav')
                </div>
                <form action="" method="post" id="private_note">
                    @csrf
                    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
                    <textarea name="content" class="summernote" id="note" cols="30" rows="10">{!! $note->content ?? '' !!}</textarea> 
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary" type="submit">Save</button>     
                    </div>  
                </form> 
            </div>
        </div>
    </div>
</div>
   
@endSection
@section('script')
    <script>
        $('#private_note').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                url:"{{ route('project.private.notes.save') }}",
                type:"POST",
                data:data,
                beforeSend:function(){
                    $('button[type="submit"]').attr('disabled',true).text('Saving...');
                },
                success:function(response)
                {
                    if(response.status == 'success')
                    {
                        $('button[type="submit"]').attr('disabled',false).text('Save');
    
                    }
                }
            });
        });
    </script>
@endsection
