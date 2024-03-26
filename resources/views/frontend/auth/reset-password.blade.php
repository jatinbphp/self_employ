@extends('frontend.layouts.app')

@section('content')
    <div class="main-content-bx01 login-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-bx001">
                        <h1>Uppdatera lösenord</h1>
                        @foreach ($errors->all() as $error)
                        @endforeach
                        <form class="needs-validation" method="post" action="{{ route('auth.reset.pass.process',['token'=>request()->get('token'), 'otp'=>request()->get('otp')]) }}"
                            novalidate="">
                            @csrf
                            <p>New Password</p>
                            <div class="input-group mb-3">
                                <input type="password" name="password"
                                    class="form-control form-control-lg  {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    placeholder="Enter your password" value="{{ old('password') }}">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <p>Confirm New Password</p>
                            <div class="input-group mb-3">

                                <input type="password" name="confirm_password"
                                    class="form-control form-control-lg  {{ $errors->has('confirm_password') ? 'is-invalid' : '' }}"
                                    placeholder="Enter your confirm password" value="{{ old('confirm_password') }}">

                                @error('confirm_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group sibmit-btn01">
                                <input type="submit" class="subt-btn1" id="formControlRange" value="Hitta annonser">
                            </div>
                            <div class="forget-passbx01">
                                <ul>
                                    <li><a href="{{ route('auth.login.showform') }}">Login</a></li>
                                    {{-- <li>
									<a href="#">
										<div class="bankid-img"><img src="{{asset('assets/images/bankid.png')}}"></div>
										Create Account
									</a>
								</li> --}}
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
