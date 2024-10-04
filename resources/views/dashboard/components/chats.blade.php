@foreach ($chats as $chat)
    @if($chat->user_id == auth()->user()->id)
        <div class="media d-flex  mb-4">
            <div class="px-3 py-2 ml-auto speech-bubble">
                {!! $chat->content !!}
            </div>
            <div class="ml-4">
                <a href="#">
                    <img src="{{ $chat->user->avatar ? asset('avatars').'/'.$chat->user->avatar : asset('default-avatar.webp') }}" alt="" class="img-fluid rounded-circle chat_user_img">
                </a>
            </div>
        </div>
    @else
        <div class="media d-flex mb-4">
            <div class="mr-4 thumb-img">
                <a href="#">
                    <img src="{{ $chat->user->avatar ? asset('avatars').'/'.$chat->user->avatar : asset('default-avatar.webp') }}" alt="" class="img-fluid rounded-circle chat_user_img">
                </a>
            </div>
            <div class="px-3 py-2 mr-auto speech-bubble alt">
                <strong>{{ $chat->user->name }}</strong><br>
                {!! $chat->content !!}
            </div>
        </div>
    @endif
@endforeach

