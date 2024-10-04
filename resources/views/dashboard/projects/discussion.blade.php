@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="chat-screen">
        <a href="#" class="chat-contact round-button d-inline-block d-lg-none"><i class="icon-menu"></i></a>
        <a href="#" class="chat-profile d-inline-block d-lg-none"><img class="img-fluid  rounded-circle" src="{{ asset('assets/images/team-3.jpg') }}" width="30" alt=""></a>
        <div class="row row-eq-height">
            <div class="col-12  mt-3 pl-lg-0 pr-lg-0">
                <div class="card border h-100 rounded-0">
                    <div class="card-body p-0">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                <ul class="nav flex-column chat-menu" id="myTab3" role="tablist">
                                    <li class="nav-item active px-3 px-md-1 px-xl-3">                                               
                                        <div class="media d-block d-flex text-left py-2">
                                            <div style="background-color: {{ $project->color }};width:50px;height:50px;border-radius:50%;margin-right: 10px;"></div>
                                            <div class="media-body align-self-center mt-0  d-flex">
                                                <div class="message-content"> <h6 class="mb-1 font-weight-bold d-flex">{{ $project->name }}</h6>
                                                    Discussion
                                                </div>
                                            </div>
                                        </div>                                               
                                    </li>
                                </ul>
    
    
    
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 460px;">
                                    <div class="scrollerchat p-3" id="chats" style="overflow-y: scroll; width: auto; height: 460px;">   
    
                                    </div>
                                <div class="slimScrollBar" style="background: rgb(255, 255, 255); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 0px; height: 272.68px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 0px;"></div></div>
                                <div class="border-top theme-border px-2 py-3 d-flex position-relative chat-box">
                                    <div id="message-box" contenteditable="true" style="border: 1px solid #ccc; padding: 10px; min-height: 100px;width: 100%;" placeholder="dsfskjd"></div>                                              
                                    <button type="button" id="sendMsg" class="p-2 ml-2 rounded line-height-21 bg-primary text-white">Send <i class="icon-cursor align-middle"></i></button>
                                </div>
    
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection
@section('script')
<script>
    document.getElementById('message-box').addEventListener('paste', function(event) {
        event.preventDefault();
        const items = (event.clipboardData || event.originalEvent.clipboardData).items;
        for (let i = 0; i < items.length; i++) {
            if (items[i].kind === 'file' && items[i].type.startsWith('image/')) {
                const blob = items[i].getAsFile();
                const reader = new FileReader();
                reader.onload = function(e) {
                    uploadImage(blob);
                };
                reader.readAsDataURL(blob);
            }
        }
    });

    function uploadImage(blob) {
        const formData = new FormData();
        formData.append('image', blob);

       $.ajax({
           url: "{{ route('project.image.upload') }}",
           type: 'POST',
           data: formData,
           processData: false,
           contentType: false,
           success: function(data) {
               if(data.success){
                const imgContainer = `
                    <div class="image-wrapper">
                        <img src="${data.url}" alt="" class="img-fluid">
                        <button class="delete-btn" data-path="${data.path}"><i class="bx bx-trash"></i></button>
                    </div>
                    <br>`;
                document.getElementById('message-box').innerHTML += imgContainer;
                attachDeleteEvent();
               }
           }
           
       });
    }
    function attachDeleteEvent() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const path = this.getAttribute('data-path');
                const imageWrapper = this.closest('.image-wrapper');

                $.ajax({
                    url: "{{ route('project.image.delete') }}",
                    type: 'POST',
                    data: {
                        path: path,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.success) {
                            imageWrapper.remove();
                        }
                    }
                });
            });
        });
    }
    function getMessages(id) {
        $.ajax({
            url: "{{ route('project.messages') }}",
            type: 'POST',
            data: {
                project_id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                const chats = $('#chats');
                const isScrolledToBottom = chats[0].scrollHeight - chats.scrollTop() === chats.outerHeight();
                $('#chats').html(data);
                if (isScrolledToBottom) {
                    scrollToBottom();
                }
            }
        });
    }
    function scrollToBottom() {
        const chats = $('#chats');
        chats.scrollTop(chats[0].scrollHeight); 
    }

    $(document).ready(function(){
        getMessages('{{ $project->id }}');

        setInterval(() => {
            getMessages('{{ $project->id }}');
        }, 3000);

        $(document).on('click','#sendMsg',function(){
            $('#message-box .delete-btn').remove();
            var message = $('#message-box').html();
            var project_id = "{{ $project->id }}";
            
            if(message.trim() != 0){
                $.ajax({
                    url: "{{ route('project.message.store') }}",
                    type: 'POST',
                    data: {
                        message: message,
                        project_id: project_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if(data.status == 'success'){
                            $('#message-box').html('');
                        }
                    }
                });
            }
        });
    });
</script>
@endSection