{{-- <div class="chat-bx11" id="chat_box" style="display: none;"> --}}
<div id="chat_box" class="chat-bx11 pull-right chat-bx-open" style="display: none">
    <div class="user-chatbx">
        <!---- online / offline ---->
        <div class="username11" >
            <h4><a class="chat-user"></a></h4>
            <p><a class="project-name"></a></p>
        </div>
        <div class="icon-bxright">
            <div class="fulscreen-icon">
                <a href="javscript:void(0)">
                    <img src="{{ asset('assets/images/fullscreen.png') }}">
                </a>
            </div>
            <div class="closed-icon close-chat close-icon-chat">
                <a href="javascript:void(0)">
                    <img src="{{ asset('assets/images/closed-icon2.png') }}">
                </a>
            </div>
        </div>
    </div>
    <div class="mileston-bx" style="display: none;">
        <button id="">Award</a>
    </div>
    <div class="chat-viewbx1 panel-body chat-area chat-area-bx"></div>
    <div class="chat-commentbx1">
        <div class="attech-file-icon">
            <form method="post" enctype="multipart/form-data" class="upload-frm">
                <label for="first-img1">
                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                </label>
                <input type="file" name="image" class="image" id="first-img1"
                    style="display: none !important;visibility: none;" />
                    {{-- accept="image/png, image/gif, image/jpeg"  --}}
            </form>
        </div>
        <div class="comment-inputbx1">
            <div class="inputbxx1">
                <input type="text" name="comments1" class="chat_input" placeholder="Type a message...">
            </div>
        </div>
        <div class="comment-rightbx1">
            <div class="emoji-bx01 emoji-bx">
                <a href="javascript:void(0)">
                    <i class="fa fa-smile-o" aria-hidden="true"></i>
                </a>
            </div>
            <div class="submit-chatbtn01 btn-chat" disabled>
                <a type="button" >
                    <img src="{{ asset('assets/images/plane-img.png') }}">
                </a>
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
</div>
<div class="modal fade" id="createMilestoneModal" tabindex="-1" aria-labelledby="createMilestoneModalLabel"
    aria-hidden="true">
    <div class="modal-dialog create-popupbx">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a milestone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="create-popup-contentbx1">
                    <div class="create-requestbx">
                        <div class="alert-wrapper"></div>
                        <h4>Amount Requested</h4>
                        <div>
                            <div class="number-input" style="margin-left: 0px; margin-bottom:12px;">
                                <input type="number" id="milestone_amount" class="form-control" placeholder="$0.00" required>
                            </div>
                            <input type="hidden" id="milestone_project_id" value="{{isset($project)?$project->id:''}}">
                            <div class="create-formbx1">
                                <h4>Message</h4>
                                <textarea class="form-control" id="milestone_description" rows="3" placeholder="Write Message here..."></textarea>
                                <div class="create-milestone-btn-part">
                                    <button type="button" class="btn btn-success" id="request_milestone" style="width: 165px;">Create</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="margin-left: 15px;" >Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
