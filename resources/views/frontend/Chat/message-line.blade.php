@if ($message->from_user == auth()->user()->id)
    <div class="second-user msg_container base_sent receive-txt" data-message-id="{{ $message->id }}"
        id="message-line-{{ $message->id }}">
        <div class="user-title01">
            <span>{{ substr($message->fromUser->first_name, 0, 1) }}</span>
        </div>
        <p style="background-color:{{ $message->type==0?'':'lightblue' }}">
            @if (!empty($message->content))
                {!! $message->content !!}
            @else
                @if (explode('.', $message->image)[1] == 'jpg' ||
                    explode('.', $message->image)[1] == 'jpeg' ||
                    explode('.', $message->image)[1] == 'png')
                    <img src="{{ $message->image_url }}">
                @else
                    <a href="{{ $message->image_url }}">{{ $message->image }}</a>
                @endif
            @endif
            <time datetime="{{ date('Y-m-dTH:i', strtotime($message->created_at->toDateTimeString())) }}">
                {{ $message->created_at->diffForHumans() }}
                <img src="{{ asset('assets/images/doubletick.png') }}">
            </time>
        </p>
    </div>
@else
    <div class="my-chat1 second-user msg_container base_receive receive-txt" data-message-id="{{ $message->id }}"
        id="message-line-{{ $message->id }}">
        <p style="background-color:{{ $message->type==0?'':'darkblue' }}">
            @if (!empty($message->content))
                {!! $message->content !!}
            @else
                @if (explode('.', $message->image)[1] == 'jpg' ||
                    explode('.', $message->image)[1] == 'jpeg' ||
                    explode('.', $message->image)[1] == 'png')
                    <img src="{{ $message->image_url }}">
                @else
                    <a href="{{ $message->image_url }}">{{ $message->image }}</a>
                @endif
            @endif
            <time datetime="{{ date('Y-m-dTH:i', strtotime($message->created_at->toDateTimeString())) }}">
                {{ $message->created_at->diffForHumans() }}
                <img src="{{ asset('assets/images/doubletick.png') }}">
            </time>
        </p>
        <div class="user-title01">
            <span>{{ substr($message->fromUser->first_name, 0, 1) }}</span>
        </div>
    </div>
@endif
