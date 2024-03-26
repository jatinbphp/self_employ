    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog madeoferopup">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-bx001">
                        <h1>Make an Offer</h1>
                        <form action="{{ route('projects.makeoffer') }}" id="make_offer_modal_form" method="post">
                            @csrf
                            <div class="number-inputbxo1">
                                <input type="hidden" name="post_id" value="{{ $project->id }}">
                                <input type="hidden" name="user_id"
                                    value="{{ auth()->check() ? auth()->user()->id : '' }}">
                                <h4>$</h4>
                                <input type="number" name="amount" class="form-control form-control-lg" value="1"
                                    min="1" max="999">
                            </div>
                            <p>Why are you the best person for this task?</p>
                            <textarea class="form-control" name="description" rows="5" id="description" placeholder="Write here......"></textarea>
                            <div class="form-group sibmit-btn01">
                                <input type="submit" class="subt-btn1" id="make_offer_modal_form_submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
