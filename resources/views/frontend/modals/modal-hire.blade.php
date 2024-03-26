<!-- Modal -->
<div class="modal fade hire_me" id="hiremestaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="hiremestaticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog madeoferopup">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hiremestaticBackdropLabel">Hire Me</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body post-taskbx01 ">
                {{-- <div class="form-bx001"> --}}
                <div class="form-spacebx1">
                    <h1>Hire Me:</h1>
                    <form action="{{ route('projects.hire') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="request_user_id" value="{{ request()->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="title">Wants to Hire</label>
                                <input class="form-control" type="text" name="title" id="title" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="starts-at">Starts at</label>
                                <input type="date" name="date" id="starts-at"
                                    class="form-control form-control-lg datepicker" min="12/29/2022" placeholder="Date">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="ends-at">Ends at</label>
                                <input type="date" name="beforedate" id="ends-at"
                                    class="form-control form-control-lg datepicker" min="12/29/2022" placeholder="Date">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="ends-at">Description</label>
                                <textarea class="form-control" name="description" rows="5" id="description" placeholder="Write here......"></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="amount">Budget for project</label>
                                <div class="address-bx11">
                                    <div class="address-iconbx">$</div>
                                    <input type="number" name="amount" value="1"
                                        class="form-control form-control-lg" placeholder="Amount eg. 5">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="budgetype">Budget Type</label>
                                <div class="radio-bx1">
                                    <input type="radio" name="budget" value="1" class="form-radio">
                                    <label for="budget">Per Hour</label>
                                </div>
                                <div class="radio-bx1">
                                    <input type="radio" name="budget" value="2" class="form-radio" checked>
                                    <label for="budget">Per Project</label>
                                </div>
                                <div class="radio-bx1">
                                    <input type="radio" name="budget" value="3" class="form-radio">
                                    <label for="budget">Per Day</label>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row form-group">
                        <div class="col-xs-12">
                            <label class="col-xs-4" for="budgetype">Budget Type</label>
                            <select name="budget" id="budget" class="form-select form-control-lg">
                                <option value="0">Please Select</option>
                                <option value="1">Per Hour</option>
                                <option value="2">Per Project</option>
                                <option value="3">Per Day</option>
                            </select>
                        </div>
                    </div> --}}
                        <div class="modal-footer sibmit-btn01 sibmit-btnModal">
                            <input type="button" class="btn btn-secondary btn-close1"data-bs-dismiss="modal"
                                aria-label="Close" value="Close">
                            <input type="submit" class="btn btn-primary" id="save-event" value="Hire">
                        </div>
                    </form>
                </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</div>
