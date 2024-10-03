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
    
    
    
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 460px;"><div class="scrollerchat p-3" style="overflow: hidden; width: auto; height: 460px;">   
    
                                    <div class="media d-flex  mb-4">
                                        <div class="p-3 ml-auto speech-bubble">
                                            Hello John, how can I help you today ?
                                        </div>
                                        <div class="ml-4"><a href="#"><img src="{{ asset('assets/images/author2.jpg') }}" alt="" class="img-fluid rounded-circle"></a></div>
                                    </div>
                                    <div class="media d-flex mb-4">
                                        <div class="mr-4 thumb-img"><a href="#"><img src="{{ asset('assets/images/author3.jpg') }}" alt="" class="img-fluid rounded-circle"></a></div>
                                        <div class="p-3 mr-auto speech-bubble alt">
                                            Hi, I want to buy a new shoes.
                                        </div>
                                    </div>
                                    <div class="media d-flex mb-4">
                                        <div class="p-3 ml-auto speech-bubble">
                                            Shipment is free. You'll get your shoes tomorrow!<br>
                                            <img src="{{ asset('assets/images/shoes.jpg') }}" alt="" width="300" class="img-fluid mt-2">
                                        </div>
                                        <div class="ml-4"><a href="#"><img src="{{ asset('assets/images/author2.jpg') }}" alt="" class="img-fluid rounded-circle"></a></div>
                                    </div>
    
                                    <div class="media d-flex mb-4">
                                        <div class="mr-4 thumb-img"><a href="#"><img src="{{ asset('assets/images/author3.jpg') }}" alt="" class="img-fluid rounded-circle"></a></div>
                                        <div class="p-3 mr-auto speech-bubble alt">
                                            Wow that's great!
                                        </div>
                                    </div>
                                    <div class="media d-flex mb-4">
                                        <div class="mr-4 thumb-img"><a href="#"><img src="{{ asset('assets/images/author3.jpg') }}" alt="" class="img-fluid rounded-circle"></a></div>
                                        <div class="p-3 mr-auto speech-bubble alt">
                                            Ok. Thanks for the answer. Appreciated.<br>
                                            <div class="embed-container mt-2"><iframe src="https://player.vimeo.com/video/66140585" class="border-0" allowfullscreen=""></iframe></div>
                                        </div>
                                    </div>
                                    <div class="media d-flex mb-4">
                                        <div class="p-3 ml-auto speech-bubble">
                                            You are welcome!
                                        </div>
                                        <div class="ml-4"><a href="#"><img src="{{ asset('assets/images/author2.jpg') }}" alt="" class="img-fluid rounded-circle"></a></div>
                                    </div>
    
                                </div><div class="slimScrollBar" style="background: rgb(255, 255, 255); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 0px; height: 272.68px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 0px;"></div></div>
                                <div class="border-top theme-border px-2 py-3 d-flex position-relative chat-box">
                                    <div id="message-box" contenteditable="true" style="border: 1px solid #ccc; padding: 10px; min-height: 100px;width: 100%;"></div>                                              
                                    <a href="#" class="p-2 ml-2 rounded line-height-21 bg-primary text-white"><i class="icon-cursor align-middle"></i></a>
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
                    </div>`;
                document.getElementById('message-box').innerHTML += imgContainer;

                // Attach delete event to the new delete button
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
</script>
@endSection