@extends('frontend.layouts.app')

@section('content')
<div class="main-content-bx01 login-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="form-bx001">
                    <h1>Make an Offer</h1>
                    <form action="" class="">
                        <div class="number-inputbxo1">
                            <h4>$</h4>
                            <input type="number" class="form-control form-control-lg" value="1" min="1" max="999">
                        </div>
                        <p>Why are you the best person for this task?</p>
                        <div class="input-group mb-3">
                            <textarea class="form-control" rows="5" id="comment" placeholder="Write here......"></textarea>
                        </div>
                        <div class="form-group sibmit-btn01">
                            <input type="submit" class="subt-btn1" id="formControlRange" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
