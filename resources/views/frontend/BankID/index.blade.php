@extends('frontend.layouts.app')

@section('content')
    <div class="main-content-bx01 bg-colorbx">
        <div class="container">
            <div class="row">
                <div class="post-task-title">
                    <h1>Bank ID</h1>
                </div>
                <div class="post-taskbx01">
                    <div class="form-spacebx1">
                        <form method="post" action="{{ route('bankid.post') }}" enctype="multipart/form-data">
                            @csrf
                            <p>Personal Number</p>
                            <div class="form-group required-fieldbx">
                                <input type="text" name="personal_number" value="{{ old('personal_number') }}"
                                    class="form-control form-control-lg {{ $errors->has('personal_number') ? 'is-invalid' : '' }}"
                                    placeholder="XXXXXXXX-XXXX">
                                @error('personal_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="submit-btnbx0">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
