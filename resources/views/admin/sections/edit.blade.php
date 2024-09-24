@extends('layouts.admin')

@section('admin')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4>Sections</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sections</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('admin.sections.index') }}" class="btn btn-primary float-end"><i class="mdi mdi-arrow-left me-1"></i> Back</a>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Section</h4>
                    <form action="{{ route('admin.sections.update', $section->id) }}" id="dynamicForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6 mt-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required value="{{ $section->title }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label for="statusa">Status</label>
                                <select name="status" id="statusa" class="form-control">
                                    <option value="1" @if($section->status == 1) selected @endif>Active</option>
                                    <option value="0" @if($section->status == 0) selected @endif>Disable</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label for="fields">Select Fields</label>
                                <select name="fields" id="fields" class="form-control">
                                    <option selected disabled>Select Field</option>
                                    <option value="text">Text</option>
                                    <option value="image">Image</option>
                                    <option value="button">Button</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div id="appendFields">
                                
                                @foreach (json_decode($section->content) as $key =>  $field)
                                <?php                    
                                    $value_inp_type = $field->type === 'image' ? 'file' : 'text';
                                    $type_inp_name = $field->type === 'image' ? 'img_type[]' : 'type[]';
                                    $name_inp_name = $field->type === 'image' ? 'img_name[]' : 'name[]';
                                    $label_inp_name = $field->type === 'image' ? 'img_label[]' : 'label[]';
                                    $value_inp_name = $field->type === 'image' ? 'img_value[]' : 'value[]';
                                ?>
                                <div class="row border-bottom py-3">
                                    <div class="mt-3 col-md-2">
                                        <label for="type">Type</label>
                                        <input type="text" name="{{$type_inp_name}}" id="type" readonly value="{{ $field->type }}" class="form-control" required>
                                    </div>
                                    <div class="mt-3 col-md-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="{{$name_inp_name}}" id="name" readonly class="form-control inp_validate" value="{{ $key }}" required>
                                        <small class="error"></small>
                                    </div>
                                    <div class="mt-3 col-md-3">
                                        <label for="label">Label</label>
                                        <input type="text" name="{{$label_inp_name}}" id="label" class="form-control" value="{{ $field->label }}" required>
                                    </div>
                                    <div class="mt-3 col-md-3">
                                        <label for="value">Value</label>
                                        @if($field->type == 'image')
                                            <img src="{{ asset('sections').'/'. $field->value }}" height="150" width="100%" alt="">
                                            <input type="hidden" name="img_value[]" value="{{ $field->value }}">
                                        @endif
                                        <input type="{{$value_inp_type}}" name="{{$value_inp_name}}" id="value" value="{{ $field->value }}" class="form-control">
                                    </div>
                                    <div class="mt-3 col-md-1">
                                        <a href="javascript:void(0)" class="btn btn-danger mt-4 remove"><i class="mdi mdi-minus"></i></a>
                                    </div>
                                </div>  
                                @endforeach
                            </div>

                            <div class="form-group col-md-12 mt-3 text-end">
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endSection
@section('script')
    <script>
       $(document).ready(function() {
            $(document).on('change', '#fields', function() {
                var value = $(this).val();
                var value_inp_type = value === 'image' ? 'file' : 'text';
                var type_inp_name = value === 'image' ? 'img_type[]' : 'type[]';
                var name_inp_name = value === 'image' ? 'img_name[]' : 'name[]';
                var label_inp_name = value === 'image' ? 'img_label[]' : 'label[]';
                var value_inp_name = value === 'image' ? 'img_value[]' : 'value[]';
                var html = `<div class="row border-bottom py-3">
                                <div class="mt-3 col-md-2">
                                    <label for="type">Type</label>
                                    <input type="text" name="${type_inp_name}" id="type" readonly value="${value}" class="form-control" required>
                                </div>
                                <div class="mt-3 col-md-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="${name_inp_name}" id="name" readonly class="form-control inp_validate" required>
                                    <small class="error"></small>
                                </div>
                                <div class="mt-3 col-md-3">
                                    <label for="label">Label</label>
                                    <input type="text" name="${label_inp_name}" id="label" class="form-control" required>
                                </div>
                                <div class="mt-3 col-md-3">
                                    <label for="value">Value</label>
                                    <input type="${value_inp_type}" name="${value_inp_name}" id="value" class="form-control" required>
                                </div>
                                <div class="mt-3 col-md-1">
                                    <a href="javascript:void(0)" class="btn btn-danger mt-4 remove"><i class="mdi mdi-minus"></i></a>
                                </div>
                            </div>`;
                $('#appendFields').append(html);
            });

            $(document).on('click', '.remove', function() {
                $(this).closest('.row').remove();
            });

            $(document).on('keyup', '.inp_validate', function() {
                validateUniqueValue($(this));
            });

            function validateUniqueValue($currentInput) {
                let currentValue = $currentInput.val().replace(/\s/g, '').toLowerCase();
                let isDuplicate = false;

                if (/\s/.test($currentInput.val()) || /[A-Z]/.test($currentInput.val())) {
                    $currentInput.parent().find('.error').text('No spaces or capital letters allowed!');
                    $currentInput.css('border', '2px solid red');
                    $('#submit').prop('disabled', true);
                    return;
                } else {
                    $currentInput.parent().find('.error').text('');
                    $currentInput.css('border', '');
                    $('#submit').prop('disabled', false);
                }

                $('.inp_validate').not($currentInput).each(function() {
                    if ($(this).val().trim() === currentValue && currentValue !== '') {
                        isDuplicate = true;
                    }
                });

                if (isDuplicate) {
                    $currentInput.parent().find('.error').text('Duplicate value found! Please enter a unique value.');
                    $('#submit').prop('disabled', true);
                    $currentInput.css('border', '2px solid red');
                } else {
                    $currentInput.parent().find('.error').text('');
                    $currentInput.css('border', '');
                    $('#submit').prop('disabled', false);
                }
            }

        });


    </script>
@endsection