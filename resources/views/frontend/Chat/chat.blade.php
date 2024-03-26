@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="main-content-bx01 bg-colorbx">
            <div class="row">
                <div class="post-task-title">
                    <h1>Messages</h1>
                </div>
                <div class="post-taskbx01">
                    <div class="form-spacebx1">
                        <h2>Messages</h2>
                        <div class="table-responsive">
                            @if ($users->count() > 0)
                                <ul id="user_details">
                                    @foreach ($users as $user)
                                        <li>
                                            <img src="{{ $user->profile_image }}" alt="{{ $user->name }}" width="50px">
                                            <a href="javascript:void(0);" class="chat-toggle" data-id="{{ $user->id }}"
                                                data-user="{{ $user->name }}">
                                                @if (count($user->getUserLoginHistory) > 0)
                                                    <em style="background: #21F174;width: 8px;height: 8px;display: inline-block; border-radius: 50%; margin-right: 4px;"></em>
                                                @else
                                                    <em style="background: #f10017;width: 8px;height: 8px;display: inline-block; border-radius: 50%; margin-right: 4px;"></em>
                                                @endif
                                                <span class="label label-info">{{ $user->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No Chat initiate with job poster. When Chat initiate will list the users</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
