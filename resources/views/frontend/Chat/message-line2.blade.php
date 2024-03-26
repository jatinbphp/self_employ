@if ($message->from_user == auth()->user()->id)
    <div class="row msg_container base_sent receive-txt" data-message-id="{{ $message->id }}" id="message-line-{{ $message->id }}">
        <div class="col-md-10 col-xs-10">
            <div class="messages msg_sent text-right msg-box">
                @if ($message->content)
                    <p>{!! $message->content !!}</p>
                @elseif($message->image)
                    <div style="width: 100%;">
                        <img class="img-responsive" width="80px" src="{{ $message->image_url }}" />
                    </div>
                @endif
                <time datetime="{{ date('Y-m-dTH:i', strtotime($message->created_at->toDateTimeString())) }}">
                    {{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}
                </time>
            </div>
        </div>
        <div class="col-md-2 col-xs-2 avatar chat-usr-img">
            <img src="{{ $message->fromUser->profile_image }}" width="50" height="50" class="img-responsive">
        </div>
    </div>
@else
    <div class="row msg_container base_receive receive-txt" data-message-id="{{ $message->id }}"
        id="message-line-{{ $message->id }}">
        <div class="col-md-2 col-xs-2 avatar chat-usr-img">
            <img src="{{ $message->fromUser->profile_image }}" width="50" height="50" class=" img-responsive ">
        </div>
        <div class="col-md-10 col-xs-10">
            <div class="messages msg_receive text-left msg-box">
                @if ($message->content)
                    <p>{!! $message->content !!}</p>
                @elseif($message->image)
                    <div style="width: 100%;">
                        <img class="img-responsive" src="{{ $message->image_url }}" />
                    </div>
                @endif
                <time datetime="{{ date('Y-m-dTH:i', strtotime($message->created_at->toDateTimeString())) }}">
                    {{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}
                </time>
            </div>
        </div>
    </div>
@endif
