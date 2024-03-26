<div id="chat_box" class="chat_box pull-right chat-bx-open" style="display: none">
    <div class="row">
        <div class="col-xs-12 col-md-12 chat-bx-col">
            <div class="panel panel-default">
                <div class="panel-heading heading-panelbx">
                    <h3 class="panel-title">
                        <span class="fa fa-comment"></span>
                        Chat with
                        <i class="chat-user"></i>
                    </h3>
                    <span class="fa fa-times pull-right close-chat close-icon-chat"></span>
                </div>
                <div class="panel-body chat-area chat-area-bx">
                </div>
                <div class="panel-footer chat-bx-footer">
                    <div class="input-group form-controls">
                        <div class="img-style-bx">
                            <button type="button" class="btn btn-default btn-sm upload-btn ">
                                <i class="fa fa-picture-o"></i>
                            </button>
                            <button type="button" class="btn emoji-bx">
                                <i class="" style="font-style: normal">&#128512;</i>
                            </button>
                        </div>
                        <textarea class="form-control input-sm chat_input" placeholder="Write your message here..."></textarea>
                        <button class="btn btn-primary btn-sm btn-chat" type="button" data-to-user="" disabled>
                            <i class="fa fa-paper-plane"></i>
                            Send
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data" class="upload-frm" style="display: none">
                        <input type="file" name="image" class="image" accept="image/png, image/gif, image/jpeg" />
                    </form>

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
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" class="to_user_id" value="" />
</div>
