<script>
    $(document).ready(function() {
        $(document).on('click','.show_task',function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('task.show', '') }}/" + $(this).data('id'),
                type: "GET",
                data: {
                    task_id: $(this).data('id')
                },
                success: function(data) {
                    $('body').append(data);
                    var taskModal = $(document).find('#taskModal');
                    taskModal.modal('show');
                    $(document).find('#taskModal').on('hidden.bs.modal', function () {
                        $(this).remove();
                    });
                    intTooltip();
                    intSummernote();
                    Dropzone.autoDiscover = false; 

                    let myDropzone = new Dropzone("#taskDropzone", {
                        url: "{{ url('task/file/upload') }}" + "/" + id,
                        maxFilesize: 2, // MB mein file size limit
                        addRemoveLinks: true,
                        dictDefaultMessage: "Drop files here or click to upload",
                        init: function () {
                            this.on("success", function (file, response) {
                                console.log("File uploaded successfully!");
                                file.serverFilename = response.success;
                            });
                            this.on("removedfile", function (file) {
                                // Send a request to the server to delete the file
                                if (file.serverFilename) {
                                    $.ajax({
                                        url: "{{ url('task/file/delete') }}" + "/" + file.serverFilename,
                                        type: 'POST',
                                        data: { filename: file.serverFilename },
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                                        },
                                        success: function (data) {
                                            console.log('File deleted successfully');
                                        },
                                        error: function (error) {
                                            console.error('Error deleting file:', error);
                                        }
                                    });
                                }
                            });
                        }
                    });
                },
            });
        });
        $(document).on('submit','#commentForm',function(e){
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            console.log(formData);
            
            $.ajax({
                url:"{{ route('comment.store') }}",
                type:"POST",
                data:formData,
                beforeSend: function(){
                    form.find('button[type="submit"]').prop('disabled', true).text('Commenting...');
                },
                success: function(data) {
                    if(data.status == 'success'){
                        form.find('.summernote').summernote('code', '');
                        
                    }
                },
                complete: function(){
                    form.find('button[type="submit"]').prop('disabled', false).text('Comment');
                }
            });
        });

        $(document).on('click','.comment_delete',function(e){
            e.preventDefault();
            var _this = $(this);
            var url = $(this).data('url');
            $.ajax({
                url:url,
                type:"DELETE",
                success: function(data) {
                    if(data.status == 'success'){
                        _this.closest('.comment-item').remove();
                    }
                }
            });
        });

        $(document).on('click', '.comment_edit', function(e) {
            e.preventDefault();
            $(this).addClass('d-none');
            $(this).parent().find('.comment_edit_remove').removeClass('d-none');
            $(this).parent().parent().find('.comment_content').addClass('d-none');
            $(this).parent().parent().find('.comment_update').removeClass('d-none');
            
            var textarea = $(this).parent().parent().find('.comment_update textarea');
            textarea.show().addClass('summernote');
            
            // Check if Summernote is already initialized
            if (!textarea.next('.note-editor').length) {
                intSummernote();
            }
        });

        // Handle cancel edit button click
        $(document).on('click', '.comment_edit_remove', function(e) {
            e.preventDefault();
            $(this).addClass('d-none');
            $(this).parent().find('.comment_edit').removeClass('d-none');
            $(this).parent().parent().find('.comment_update').addClass('d-none');
            $(this).parent().parent().find('.comment_content').removeClass('d-none');
            
            // Remove Summernote editor instance
            $(this).parent().parent().find('.comment_update .summernote').summernote('destroy');
            $(this).parent().parent().find('.comment_update textarea').hide();
        });

        // Handle form submission for comment update
        $(document).on('submit', '.comment_update', function(e) {
            e.preventDefault();
            var _this = $(this);
            $.ajax({
                url: _this.attr('action'),
                type: "POST",
                data: _this.serialize(),
                success: function(response) {
                    if(response.status == 'success'){
                        _this.addClass('d-none');
                        _this.parent().find('.comment_action').find('.comment_edit_remove').addClass('d-none');
                        _this.parent().find('.comment_action').find('.comment_edit').removeClass('d-none');
                        _this.parent().find('.comment_content').removeClass('d-none').html(response.data.content);
                        
                        // Destroy the Summernote editor and reset textarea
                        _this.find('.summernote').summernote('destroy');
                        _this.find('textarea').hide();
                    }
                }
            });
        });
        $(document).on('click','.delete_file',function(e){
            e.preventDefault();
            var _this = $(this);
            var url = $(this).data('url');
            $.ajax({
                url:url,
                type:"POST",
                success: function(data) {
                    if(data.status == 'success'){
                        _this.closest('.file').parent().remove();
                    }                
                }
            });
        });
        $(document).on('click','.edit_task_description',function(){
            $(this).parent().addClass('d-none');
            $(this).parent().parent().find('.task_update').removeClass('d-none');
        });

        $(document).on('submit','#updateDescription',function(e){
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var task_id = form.data('task-id');
            $.ajax({
                url:$(this).attr('action'),
                type:"POST",
                data:formData,
                success: function(data) {
                    if(data.status == 'success'){
                        // form.find('.summernote').summernote('code', '');
                        form.addClass('d-none');
                        form.parent().find('.task_description .content').html(data.data.description);
                        form.parent().find('.task_description').removeClass('d-none');
                    }
                }
            });
        });
    });
</script>