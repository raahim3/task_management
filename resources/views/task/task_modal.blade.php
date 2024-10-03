<div class="modal fade" id="taskModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <a class="modal-title h4" href="{{ route('project.tasks', $task->project->id) }}"
                    wire:navigate>{{ $task->project->name }}</a>
                @php
                    if ($task->project->status == 'in_progress') {
                        $tag = 'in-progress-tag';
                    } elseif ($task->project->status == 'completed') {
                        $tag = 'complete-tag';
                    } elseif ($task->project->status == 'on_hold') {
                        $tag = 'on-hold-tag';
                    } else {
                        $tag = 'not-started-tag';
                    }
                @endphp
                <span class="{{ $tag }} mt-1 mx-2 text-capitalize">{{ $task->project->status }}</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <style>
                .note-insert button:nth-child(2){
                    display: none;
                }
            </style>
            <div class="modal-body p-0">
                <div class="d-flex flex-wrap">
                    <div class="col-md-8 py-3 col-12">
                        <h5>{{ $task->name }}</h5>
                        <div class="task_description">
                            <a href="#" class="edit_task_description"><i class="icon-pencil"></i></a>
                            <div class="content">{!! $task->description !!}</div>
                        </div>
                        <form action="{{ route('task.update.description', $task->id) }}" method="post" id="updateDescription" class="task_update d-none">
                            <textarea name="description" class="summernote" id="" cols="30" rows="10">{!! $task->description !!}</textarea>
                            <button type="submit" class="btn btn-info mt-4">Update</button>
                        </form>
                        <div class="d-flex flex-wrap files_main p-2">
                            @foreach ($task->files as $file)
                              <div class="col-md-3 col-6 p-1 ">
                                <a class="file" href="{{ asset($file->path) }}" target="_blank" download>
                                  <i class="icon-trash text-danger delete_file" data-url="{{ route('task.file.delete', $file->id) }}"></i>
                                  @if($file->file_type == 'image')
                                    <img src="{{ asset($file->path) }}" alt="{{ $file->name }}">
                                  @else
                                    <i class="icon-file"></i>
                                    <span>{{ $file->name }}</span>
                                  @endif
                                </a>
                              </div>
                            @endforeach
                          </div>
                        <div>
                            <form class="comment_main" id="commentForm" method="POST">
                                <input type="hidden" name="id" value="{{ $task->id }}">
                                <textarea name="comment" class="summernote" id="" cols="30" rows="8"></textarea>
                                <div class="d-flex justify-content-end mt-3">
                                    <button class="btn btn-primary" type="submit">Comment</button>
                                </div>
                            </form>
                        </div>
                        <div class="comments mt-4">
                            <h5>Comments</h5>
                            <hr>
                            @foreach ($task->comments as $comment)
                                <div class="comment-item">
                                    @if (auth()->check() && auth()->user()->id == $comment->user_id)
                                        <div class="comment_action">
                                            <a href="#" data-url="{{ route('comment.edit', $comment->id) }}"
                                                class="text-primary comment_edit"><i class="icon-note fs-4"></i></a>
                                            <a href="#" class="text-danger comment_edit_remove d-none"><i
                                                    class="icon-close fs-4"></i></a>
                                            <a href="#" data-url="{{ route('comment.destroy', $comment->id) }}"
                                                class="text-danger comment_delete"><i class="icon-trash fs-4"></i></a>
                                        </div>
                                    @endif
                                    <div>
                                        <img src="{{ $comment->user->avatar ? asset('avatars/' . $comment->user->avatar) : asset('default-avatar.webp') }}"
                                            alt="" class="rounded-circle" width="30" height="30">
                                        <strong>{{ $comment->user->name }}</strong>
                                    </div>
                                    <div class="mt-2 comment_content">
                                        {!! $comment->content !!}
                                    </div>
                                    <form class="comment_update d-none"
                                        action="{{ route('comment.update', $comment->id) }}" method="POST">
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ $comment->id }}">
                                        <textarea name="comment" id="" cols="30" rows="10">{!! $comment->content !!}</textarea>
                                        <button type="submit" class="btn btn-info float-right mt-2">Update</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 col-12 bg-light py-2">
                        <div class="task_details">
                            <h5 class="fw-bolder">Task Details</h5>
                            <p class="mt-3">Created By: <strong>{{ $task->user->name }}</strong></p>
                            <p class="mt-3">Created At: <strong>{{ $task->created_at->diffForHumans() }}</strong></p>
                            <p>Status: <strong>{{ formatText($task->status) }}</strong></p>
                            <p>Priority: <strong>{{ formatText($task->priority) }}</strong></p>
                            <p>Due Date: <strong>{{ formatDate($task->due_date) }}</strong></p>
                        </div>
                        <div class="task_assignees">
                            <h5 class="fw-bolder">Assignees</h5>
                            <div class="mx-2">
                                @foreach ($task->users as $assignee)
                                    <a href="#" class="assignee" data-toggle="tooltip" data-placement="top"
                                        title="{{ $assignee->name }}">
                                        <img src="{{ $assignee->avatar ? asset('avatars/' . $assignee->avatar) : asset('default-avatar.webp') }}"
                                            alt="" class="img-fluid rounded-circle">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <form action="{{ route('task.file.upload', $task->id) }}"
                                class="dropzone dropzone-primary dz-clickable mt-3" id="taskDropzone">
                                <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
