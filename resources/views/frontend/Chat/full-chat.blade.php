@extends('frontend.layouts.app')

@section('content')
    <div class="container-fluid" style="background:#fff">
        <div class="row">
            <div class="col-xl-3 after-this ow-position-rel padding-none">
                <div class="topbar-bx1">
                    <div class="user-aligbx1">
                        <div class="user-detailbx1">
                            <h3>{{ auth()->user()->name }}</h3>
                            <p>{{ auth()->user()->city . ', ' . auth()->user()->country }}</p>
                        </div>
                        <div class="user-imagebgbx1">
                            <div class="user-imgbxx1">
                                <img src="{{ auth()->user()->profile_image }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="select-userchatbx1">
                    <div class="user-chatalignbx1" id="listUsersDiv">
                        @foreach ($messages as $message)
                            <div class="select-chtbx1">
                                <a 
                                    class="chat-toggle1" 
                                    @if ($message->from_user == auth()->user()->id)
                                        data-id="{{ $message->toUser->id }}"
                                        data-user="{{ $message->toUser->name }}"
                                    @else 
                                        data-id="{{ $message->fromUser->id }}"
                                        data-user="{{ $message->fromUser->name }}"
                                    @endif
                                    data-project_id="{{ $message->post_id }}"
                                    data-project_name="{{ $message->post->name }}"
                                >

                                    <div class="chatimgleft">
                                        @if($message->from_user == auth()->user()->id)
                                            <img src="{{ $message->toUser->profile_image }}">
                                         @else 
                                            <img src="{{ auth()->user()->profile_image }}">
                                         @endif
                                    </div>
                                    <div class="chat-txtbxright">
                                        <div class="title-row">
                                            @if($message->from_user == auth()->user()->id)
                                                <h4 style="color:black;">{{ $message->toUser->name }}</h4>
                                                <p>{{ $message->date_human_readable }}</p>
                                            @else
                                                <h4  style="color:black;">{{ $message->fromUser->name }}</h4>
                                                <p>{{ $message->date_human_readable }}</p>
                                            @endif
                                        </div>
                                        @if($message->from_user == auth()->user()->id)
                                            <p>{{ "You: ".Illuminate\Support\Str::limit($message->content, 20) }}</p>
                                        @else
                                            <p>{{ Illuminate\Support\Str::limit($message->content, 20) }}</p>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="bottom-user-searchbx1">
                    <div class="user-searchbx1">
                        <div class="user-icon0bx11">
                            <img src="{{ asset('assets/images/simple-usericon1.png') }}">
                        </div>
                        <div class="user-iconbx10">
                            <div class="searchicon11">
                                <div class="formbxx1">
                                    <form>
                                        <div class="searchinputbx1">
                                            <input class="inputsearch111" id="search" type="text" placeholder="Search..."
                                                name="searchuser">
                                            <input type="submit" class="submitbtn01" name="submitbtn" value="">
                                        </div>
                                    </form>
                                </div>
                                <!-- <a href="#" class="search-btnx1">
                            <img src="{{ asset('assets/images/search-icon11.png') }}">
                           </a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Here is the chat part -->
            <div class="col-xl-6 padding-none" id="chat-overlay1">
                
            </div>
            <div id="chat_box1" style="display: none;">
                <div class="topbar-bx1 topbar-bx2 user-chatbx">
                    <div class="online-userbx1">
                        <div class="online-useralignbx1">
                            <div class="onuserimg"><img src="{{ asset('assets/images/simple-usericon1.png') }}"></div>
                            <div class="onusertxtbx">
                                <h4 class="chat-user1"></h4>
                                <p class="project-name1"></p>
                                <!---- online / offline ---->
                                <p id="online">Online</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="online-chat-txtbx01 chat-viewbx1">
                    <div class="my-chat-bx01">
                        <div class="my-talkbx1">
                            <div class="my-talk-commentbx1 chat-area1">        </div>
                            <div class="my-talkimg1"><img src="{{ asset('assets/images/defult-user2.png') }}"></div>
                        </div>
                    </div>
                </div>
                <div class="bottom-user-searchbx1">
                    <div class="user-searchbx1 chat-type-txt-sec01">
                        <form method="post" enctype="multipart/form-data" class="upload-frm">
                            <label for="attechfile1" class="fileattech-input1">
                                <i aria-hidden="true">
                                    <div class="user-icon0bx11">
                                        <img src="{{ asset('assets/images/attech-icon111.png') }}">
                                    </div>
                                </i>
                            </label>
                            <input type="file" name="image" class="image" id="attechfile1"
                                style="display: none;visibility: none;">
                        </form>
                        <div class="user-iconbx10">
                            <div class="searchicon11">
                                <div class="formbxx1">
                                    <div class="searchinputbx1">
                                        <input class="inputsearch111 chat_input1" type="text" placeholder="Type a message..."
                                            name="comments12">
                                        <div class="emoji-bx01 emoji-bx" disabled>
                                            <a href="javascript:void(0)" class="imojiicon-img11"><img
                                                src="{{ asset('assets/images/emoji-iconsmile1.png') }}">
                                            </a>
                                        </div>
                                        <div class="submit-chatbtn01 btn-chat1" disabled>    
                                         <input type="button" class="submitbtn01" name="submitbtn">
                                        </div>
                                    </div>
                                </div>
                                <!-- <a href="#" class="search-btnx1">
                                <img src="{{ asset('assets/images/search-icon11.png') }}">
                                </a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="emoji-list" style="display: none">
                    <ul>
                        <li><a href="javascript:void(0);" class="emoji">&#128512;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128513;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128514;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128515;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128516;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128517;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128518;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128519;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128520;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128521;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128522;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128523;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128524;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128525;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128526;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128527;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128528;</a></li>
                        <li><a href="javascript:void(0);" class="emoji">&#128529;</a></li>
                    </ul>
                </div>
            <!-- End chat part -->
        </div>
        <div class="col-xl-3 padding-none ow-position-rel-2">
            <div class="topbar-bx1 topbar-bx3">
                <div class="user-aligbx1">
                    <div class="user-detailbx1">
                        <h3>Noah Loren</h3>
                        <p>England - UK</p>
                    </div>
                    <div class="user-imagebgbx1">
                        <div class="user-imgbxx1"><img src="{{ asset('assets/images/user002.png') }}"></div>
                    </div>
                </div>
            </div>
            <div class="select-userchatbx1 third-section01">
                <div class="user-chatalignbx1"> </div>
            </div>
            <div class="bottom-user-searchbx1">
                <!-- <div class="user-searchbx1">
                         <div class="user-icon0bx11"><img src="{{ asset('assets/images/simple-usericon1.png') }}"></div>
                         <div class="user-iconbx10">
                          <div class="searchicon11">
                           <div class="formbxx1">
                            <form>
                             <div class="searchinputbx1">
                              <input class="inputsearch111" type="text" placeholder="Search..." name="searchuser">
                              <input type="submit" class="submitbtn01" name="submitbtn" value="">
                             </div>
                            </form>
                           </div>
                           <a href="#" class="search-btnx1">
                            <img src="{{ asset('assets/images/search-icon11.png') }}">
                           </a>
                          </div>
                         </div>
                        </div> -->
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
{{-- Pusher Chat Functionality --}}

    <script>
        $( document ).ready(function() {
            $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                url : base_url + "/fullchat",
                data: {
                    'search':$value,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "GET",
                success:function(data){
                    $('#listUsersDiv div').empty();
                    $('#listUsersDiv').html(data);
                }
            });  
        })
    
        var postID = "<?php echo isset($messages) && count($messages) > 0 ? $messages[0]['post_id'] : null; ?>";

        if (postID) {
            let user_id = $(".chat-toggle1").first().attr("data-id");
            let username = "Please select chat"

            let project_id = $(".chat-toggle1").first().attr("data-project_id");
            let project_name = $(".chat-toggle1").first().attr("data-project_name");
                
            cloneChatBox(user_id, username, project_id, project_name, function() {
                let chatBox = $("#chat_box_" + project_id);
                if (!chatBox.hasClass("chat-opened")) {
                    chatBox.addClass("chat-opened").slideDown("fast");
                    //chatBox.attr('data-to_user_id', user_id);
                    // loadLatestMessages(chatBox, user_id, project_id);
                    // chatBox.find(".chat-area1").animate({
                    //     scrollTop: chatBox.find(".chat-area1").offset().top + chatBox
                    //         .find(".chat-area1").outerHeight(true)
                    // }, 800, 'swing');
                    chatBox.find(".chat-area1").animate({
                        scrollTop: chatBox.find(".msg_container").last().scrollTop()
                    }, 800, 'swing');
                    chatBox.find(".user-searchbx1").css("display", "none")

                    chatBox.find("#online").css("display", "none")
                   
                }
                chatBox.attr("id", "chat_box_placeholder")
            });            
        }
        
    
    });
        $(document).on('click', '.imojiicon-img11', function() {
            $('.emoji-list1').toggle();
        })
        $(function() {
            let pusher = new Pusher($("#pusher_app_key").val(), {
                cluster: $("#pusher_cluster").val(),
                encrypted: true
            });

            let channel = pusher.subscribe('chat');

            let lastScrollTop = 0;
            $(".chat-area1").on("scroll", function(e) {
                let st = $(this).scrollTop();
                if (st < lastScrollTop) {
                    fetchOldMessages($(this).parents(".chat-opened").find("#to_user_id").val(), $(this)
                        .find(".msg_container:first-child").attr("data-message-id"));
                }
                lastScrollTop = st;
            });

            // on click on any chat btn render the chat box
            $(".chat-toggle1").on("click", function(e) {
                e.preventDefault();
                let ele = $(this);
                let user_id = ele.attr("data-id");
                let username = ele.attr("data-user");
                let project_id = ele.attr("data-project_id");
                let project_name = ele.attr("data-project_name");
                cloneChatBox(user_id, username, project_id, project_name, function() {
                    let chatBox = $("#chat_box_" + project_id);
                    if (!chatBox.hasClass("chat-opened")) {
                        chatBox.addClass("chat-opened").slideDown("fast");
                        //chatBox.attr('data-to_user_id', user_id);
                        loadLatestMessages(chatBox, user_id, project_id);
                        chatBox.find(".chat-area1").animate({
                            scrollTop: chatBox.find(".chat-area1").offset().top + chatBox
                                .find(".chat-area1").outerHeight(true)
                        }, 800, 'swing');
                    }
                });
            });

            // on close chat close the chat box but don't remove it from the dom
            $(".close-chat").on("click", function(e) {
                $(this).parents("div.chat-opened").removeClass("chat-opened").slideUp("fast");
            }); // on click the btn send the message

            // on change chat input text toggle the chat btn disabled state
            $(".chat_input1").on("change keyup", function(e) {
                if ($(this).val() != "") {
                    $(this).parents(".form-controls").find(".btn-chat1").prop("disabled", false);
                } else {
                    $(this).parents(".form-controls").find(".btn-chat1").prop("disabled", true);
                }
            });
            // on click the btn send the message
            $(".btn-chat1").on("click", function(e) {

                send1($(this).attr('data-to-user'), $("#chat_box_" + $(this).attr('data-post_id')).find(
                    ".chat_input1").val(), $(this).attr('data-post_id'), null);
            });

            $(".emoji").on("click", function(e) {
                e.preventDefault();
                var textinput = $(this).parents(".chat-opened").find(".chat_input1");
                textinput.val(textinput.val() + $(this).text());
                $(this).parents(".chat-opened").find(".btn-chat1").prop("disabled", false);
                //send($(this).parents(".chat-opened").find('.to_user_id').val(), $(this).text(), null);
            });

            $(".upload-btn").on("click", function() {
                $(this).parents(".panel-footer").find(".image").trigger("click");
            });

            $(".image").on("change", function() {
                $(this).parent(".upload-frm").submit();
            });

            $(".upload-frm").on("submit", function(e) {
                e.preventDefault();
                send1($(this).parent().parent().find('.btn-chat1').attr('data-to-user'), null, $(this)
                    .parent().parent().find('.btn-chat1').attr('data-post_id'), $(this).find('.image')[
                        0].files[0])
                //send($(this).parent().find('.btn-chat').attr('data-to-user'), null, $(this).find('.image')[0].files[0]);
            });

            $(".chat_input1").on("change keyup", function(e) {
                if ($(this).val() != "") {
                    $(this).parents(".form-controls").find(".btn-chat1").prop("disabled", false);
                } else {
                    $(this).parents(".form-controls").find(".btn-chat1").prop("disabled", true);
                }
            }); // handle the scroll top of any chat box

            // listen for the send event, this event will be triggered on click the send btn
            channel.bind('send', function(data) {
                displayMessage(data.data);
            });
            // listen for the oldMsgs event, this event will be triggered on scroll top
            channel.bind('oldMsgs', function(data) {
                displayOldMessages(data);
            });
        });


        /**
         * loaderHtml
         *
         * @returns {string}
         */
        function loaderHtml() {
            return '<i class="fa fa-refresh loader"></i>';
        }


        /**
         * getChatListUsers
         *
         * this is the list of chat users on left side
         *
         * @param message
         * @returns {string}
         */
        
        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                url : base_url + "/fullchat",
                data: {
                    'search':$value,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "GET",
                success:function(data){
                    $('#listUsersDiv div').empty();
                    $('#listUsersDiv').html(data);
                }
            });
        })



        /**
         * getMessageSenderHtml
         *
         * this is the message template for the sender
         *
         * @param message
         * @returns {string}
         */
        function getMessageSenderHtml(message) {
            var html = "";
            html += `<div class="second-user msg_container person-chatbx1 base_sent" data-message-id="${message.id}">`;
            html += `<div class="user-title01">`;
            html += `<span>${message.fromUserName.charAt(0)}</span>`;
            html += `</div>`;
            if(message.type == 0)
                html += `<p>`;
            else
                html += `<p style='background-color:lightblue;'>`;
            if (message.content === "" || message.content === null) {
                if (((message.image).split("."))[1] == 'png' || ((message.image).split("."))[1] == 'jpg' || ((message.image)
                        .split("."))[1] == 'jpeg') {
                    html += `<img src="${message.image_url}">`;
                } else {
                    html += `<a href="${message.image_url}">${message.image}</a>`;
                }
            } else {
                html += `${message.content}`;
            }
            //html += `${message.content}`;
            html += `<time datetime="${message.dateTimeStr}">`;
            html += `${message.dateHumanReadable}`;
            html += `<img src="{{ asset('assets/images/doubletick.png') }}">`;
            html += `</time>`;
            html += `</p>`;
            html += `</div>`;
            return html;
        }

        /**
         * getMessageReceiverHtml
         *
         * this is the message template for the receiver
         *
         * @param message
         * @returns {string}
         */
        function getMessageReceiverHtml(message) {
            var html = "";
            html += `<div class="my-chat1 my-chat-bx01 second-user msg_container base_receive" data-message-id="${message.id}">`;
            if(message.type == 0)
                html += `<p>`;
            else
                html += `<p style='background-color:darkblue;'>`;
            if (message.content === "" || message.content === null) {
                if (((message.image).split("."))[1] == 'png' || ((message.image).split("."))[1] == 'jpg' || ((message.image)
                        .split("."))[1] == 'jpeg') {
                    html += `<img src="${message.image_url}">`;
                } else {
                    html += `<a href="${message.image_url}">${message.image}</a>`;
                }
            } else {
                html += `${message.content}`;
            }
            //html += `${message.content}`;
            html += `<time datetime="${message.dateTimeStr}">`;
            html += `${message.dateHumanReadable}`;
            html += `<img src="{{ asset('assets/images/doubletick.png') }}">`;
            html += `</time>`;
            html += `</p>`;
            html += `<div class="user-title01">`;
            html += `<span>${message.fromUserName.charAt(0)}</span>`;
            html += `</div>`;
            html += `</div>`;
            return html;
        }

        /**
         * cloneChatBox
         *
         * this helper function make a copy of the html chat box depending on receiver user
         * then append it to 'chat-overlay' div
         *
         * @param user_id
         * @param username
         * @param callback
         */
        function cloneChatBox(user_id, username, project_id, project_name, callback) {
            if ($("#chat_box_" + project_id).length == 0) {
                let cloned = $("#chat_box1").clone(true);
                // change cloned box id
                cloned.attr("id", "chat_box_" + project_id);
                cloned.find(".chat-user1").text(username);
                cloned.find(".chat-user1").attr('href', "{{ route('user.view.profile') }}/" + user_id);
                cloned.find(".project-name").text(project_name);
                cloned.find(".project-name").attr('href', "{{ route('projects.details') }}/" + project_id);
                cloned.find(".btn-chat1").attr("data-to-user", user_id);
                cloned.find(".btn-chat1").attr("data-post_id", project_id);
                cloned.find("#to_user_id").val(user_id);
                $("#chat-overlay1").empty();
                $("#chat-overlay1").append(cloned);
            }
            callback();
        }

        /**
         * loadLatestMessages
         *
         * this function called on load to fetch the latest messages
         *
         * @param container
         * @param user_id
         */
        function loadLatestMessages(container, user_id, project_id) {
            let chat_area = container.find(".chat-area1");
            let chat_viewBox = container.find(".chat-viewbx1");
            chat_area.html("");
            $.ajax({
                url: base_url + "/load-latest-messages",
                data: {
                    user_id: user_id,
                    project_id: project_id,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "GET",
                dataType: "json",
                beforeSend: function() {
                    if (chat_area.find(".loader").length == 0) {
                        chat_area.html(loaderHtml());
                    }
                },
                success: function(response) {
                    if (response.state == 1) {
                        response.messages.map(function(val, index) {
                            $(val).appendTo(chat_area);
                        });
                        chat_viewBox.animate({ scrollTop: chat_area.offset().top + chat_area.outerHeight(true) }, 800, 'swing');
                    }
                },
                complete: function() {
                    chat_area.find(".loader").remove();
                }
            });
        }
        /**
         * send
         *
         * this function is the main function of chat as it send the message
         *
         * @param to_user
         * @param message
         */
        /* function send(to_user, message, file = null) {
            let chat_box = $("#chat_box_" + to_user);
            let chat_area = chat_box.find(".chat-area");
            $.ajax({
                url: base_url + "/send",
                data: {
                    to_user: to_user,
                    message: message,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "POST",
                dataType: "json",
                beforeSend: function() {
                    if (chat_area.find(".loader").length == 0) {
                        chat_area.append(loaderHtml());
                    }
                },
                success: function(response) {},
                complete: function() {
                    chat_area.find(".loader").remove();
                    chat_box.find(".btn-chat").prop("disabled", true);
                    chat_box.find(".chat_input").val("");
                    chat_area.animate({
                        scrollTop: chat_area.offset().top + chat_area.outerHeight(true)
                    }, 800, 'swing');
                }
            });
        } */

        $('input[name="comments12"]').keypress(function(event) {
            if (event.which == 13) {
                event.preventDefault();
                send1($(this).parent().parent().parent().find('.btn-chat1').attr('data-to-user'), $(this).val(), $(
                    this).parent().parent().parent().find('.btn-chat1').attr('data-post_id'), null);
            }
        });

        $('input[name="comments12"]').click(function(event) {
            var post_id = $(this).parent().parent().parent().find('.btn-chat1').attr('data-post_id')
            $.ajax({
                url: base_url + "/read-messages",
                data: {
                    project_id: post_id,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.state == 1) {
                        $('#unread_badge_' + post_id).remove();
                        $('#total_unread_badge').text(response.unread);
                    }
                }
            });
        });

        function send1(to_user, message, post_id = null, file = null) {
            console.log("send1");
            var chat_box = $("#chat_box_" + post_id);
            var chat_area = chat_box.find(".chat-area1");
            var formData = new FormData();
            formData.append("to_user", to_user);
            formData.append("post_id", post_id);
            formData.append("_token", $("meta[name='csrf-token']").attr("content"));
            formData.append("message", message);
            formData.append("image", file);
            $.ajax({
                url: base_url + "/send",
                data: formData,
                method: "POST",
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function beforeSend() {
                    if (chat_area.find(".loader").length == 0) {
                        chat_area.append(loaderHtml());
                    }
                    chat_box.find(".chat_input1").val("");
                },
                success: function success(response) {
                    $(getMessageSenderHtml(response.data)).appendTo(chat_area);
                    chat_box.addClass("chat-area1").slideDown("fast");
                    console.log(chat_box.find(".chat-viewbx1").scrollTop());
                    chat_box.find(".chat-viewbx1").animate({
                        // scrollTop: chat_box.find(".chat-viewbx1").find('.msg_container').last().offset().top + 300
                        scrollTop: chat_box.find(".chat-viewbx1").scrollTop() + 300
                    }, 800, 'swing');
                    // getMessageSenderHtml(response.data);
                    // getMessageReceiverHtml(response.data);
                },
                complete: function complete() {
                    chat_area.find(".loader").remove();
                    chat_box.find(".btn-chat1").prop("disabled", true);
                    chat_box.find(".chat_input1").val("");
                }
            });
        }
        /**
         * This function called by the send event triggered from pusher to display the message
         *
         * @param message
         */
        function displayMessage(message) {
            let alert_sound = document.getElementById("chat-alert-sound");
            if ($("#current_user").val() == message.from_user_id) {
                let messageLine = getMessageSenderHtml(message);
                $("#chat_box_" + message.to_user_id).find(".chat-area1").append(messageLine);
            } else if ($("#current_user").val() == message.to_user_id) {
                alert_sound.play();
                // for the receiver user check if the chat box is already opened otherwise open it
                //cloneChatBox(message.from_user_id, message.fromUserName, function() {
                cloneChatBox(message.from_user_id, message.fromUserName, message.post_id, project_name = null,
                    function() {
                        let chatBox = $("#chat_box_" + message.post_id);
                        if (!chatBox.hasClass("chat-opened")) {
                            chatBox.addClass("chat-opened").slideDown("fast");
                            loadLatestMessages(chatBox, message.from_user_id, message.post_id);
                            chatBox.find(".chat-area1").animate({
                                scrollTop: chatBox.find(".chat-viewbx1").scrollTop() + 300 
                            }, 800, 'swing');
                        } else {
                            let messageLine = getMessageReceiverHtml(message);
                            // append the message for the receiver user
                            chatBox.find(".chat-area1").slideDown("fast");
                            $("#chat_box_" + message.post_id).find(".chat-area1").append(messageLine);
                            chatBox.find(".chat-viewbx1").animate({
                                scrollTop: chatBox.find(".chat-viewbx1").scrollTop() + 300 
                            }, 800, 'swing');
                        }
                    });
            }
        }

        /**
         * fetchOldMessages
         *
         * this function load the old messages if scroll up triggerd
         *
         * @param to_user
         * @param old_message_id
         */
        function fetchOldMessages(to_user, old_message_id) {
            let chat_box = $("#chat_box_" + to_user);
            let chat_area = chat_box.find(".chat-area1");
            $.ajax({
                url: base_url + "/fetch-old-messages",
                data: {
                    to_user: to_user,
                    old_message_id: old_message_id,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "GET",
                dataType: "json",
                beforeSend: function() {
                    if (chat_area.find(".loader").length == 0) {
                        chat_area.prepend(loaderHtml());
                    }
                },
                success: function(response) {},
                complete: function() {
                    chat_area.find(".loader").remove();
                }
            });
        }

        function displayOldMessages(data) {
            if (data.data.length > 0) {
                data.data.map(function(val, index) {
                    $("#chat_box_" + data.to_user).find(".chat-area1").prepend(val);
                });
            }
        }
    </script>
@endsection