@extends('frontend.layouts.app')

@section('content')
<div class="main-content-bx01 login-page">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="form-bx001">
					<h1>LOGIN</h1>
					@foreach ($errors->all() as $error)
					@endforeach
					<form method="post" action="{{route('auth.login.process')}}" class="">
						@csrf
					    <div class="input-group mb-3">
					    	<div class="inputbx001">
					    		<div class="input-img001"><img src="{{asset('assets/images/email.png') }}"></div>
						        <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter your email" {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{old('email')}}">
								@error('email')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
						    </div>
					    </div>
					    <div class="form-group">
					    	<div class="inputbx001">
					    	  <div class="input-img001"><img src="{{asset('assets/images/lockicon.png') }}"></div>
						      <input type="password" name="password" class="passwordfieldbx" id="pasword11" placeholder="Enter your Password" {{$errors->has('password') ? 'is-invalid' : ''}}" value="{{old('password')}}" >
							  @error('password')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
						  </div>
						 </div>
						 <div class="form-group sibmit-btn01">
						    <input type="submit" class="subt-btn1" id="formControlRange" value="LOGIN">
						 </div>
						 <div class="forget-passbx01">
						 	<ul>
						 		<li><a href="{{ route('auth.forgot.showform') }}">Forgot Password?</a></li>
						 		<li><a href="#">
						 			<div class="bankid-img"><img src="{{asset('assets/images/bankid.png') }}"></div>					 		
						 		Click Here</a></li>
						 		
						 	</ul>
						 </div>
						 <div class="signupbx01">
						 	<p class="text-center">Not a member?</p>
						 	<div class="signupbx01-rowbx1">

						 		<div class="signupbtn01">
						 		<a href="{{ route('auth.signup.showform') }}" >Sign up!</a></div>
						 		<div class="signuptxt01"><p>or Sign Up Using</p></div>
						 		<div class="signupsocial01">
						 			<ul>
						 				<li><a href="{{ route('auth.facebook') }}"><img src="{{asset('assets/images/ficon1.png') }}"></a></li>
						 				<!-- <li><a href="#"><img src="{{asset('assets/images/gicon.png') }}"></a></li> -->
						 			</ul>
						 		</div>
						 	</div>
						 </div>
						 <div class="remember-checkbx01">
						 	<div class="myTest custom-control custom-checkbox">
							   <input type="checkbox" class="custom-control-input" id="customCheck1" />
							   <label class="custom-control-label" for="customCheck1">Remember me</label>
							</div>
						 </div>
					</form>
					<!-- <form action="" class="">
						<p>Mejl</p>
					    <div class="input-group mb-3">
					        <input type="email" class="form-control form-control-lg" placeholder="Enter your email">
					    </div>
					    <p>Losenord</p>
					    <div class="form-group">
						      <input type="password" class="passwordfieldbx" id="pasword11" placeholder="Enter your Password" >
						 </div>
						 <div class="form-group sibmit-btn01">
						    <input type="submit" class="subt-btn1" id="formControlRange" value="Hitta annonser">
						 </div>
						 <div class="forget-passbx01">
						 	<ul>
						 		<li><a href="#">Forgotten password</a></li>
						 		<li><a href="#">
						 			<div class="bankid-img"><img src="images/bankid.png"></div>
						 		Create Account</a></li>
						 	</ul>
						 </div>
					</form> -->
				</div>
			</div>
		</div>
	</div>
</div>


{{-- <div class="main-content-bx01 login-page">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="form-bx001">
					<h1>Logga in</h1>
					@foreach ($errors->all() as $error)
					@endforeach
					<form class="needs-validation" method="post" action="{{route('auth.login.process')}}" novalidate="">
						@csrf
						<p>Mejl</p>
						<div class="input-group mb-3">
							<input type="email" name="email" class="form-control form-control-lg  {{$errors->has('email') ? 'is-invalid' : ''}}" placeholder="Ange din e-postadress" value="{{old('email')}}">
							@error('email')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<p>Lösenord</p>
						<div class="form-group">
							<input type="password" name="password" class="form-control form-control-lg {{$errors->has('password') ? 'is-invalid' : ''}}" id="pasword11" placeholder="Enter your Password" value="{{old('password')}}">
							@error('password')
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
								<li><a href="{{ route('auth.forgot.showform') }}">Glömt lösenord?</a></li>
								<li>
									<a href="#">
										<div class="bankid-img">
                                            <img src="{{asset('assets/images/bankid.png')}}">
                                        </div>
										Create Account 
									</a>
								</li>
							</ul>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="row">
		    <div class="modal fade" id="SignupModaldrop" tabindex="-1" aria-labelledby="SignupModalLabel" aria-hidden="true" data-bs-keyboard="false">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
		</div>
	</div>
</div> --}}
@endsection
