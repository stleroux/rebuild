@guest
<br /><br /><br /><br /><br /><br /><br />
dssdsd
	<div class="card mb-2">
		<div class="card-header block_header">
			<i class="fas fa-sign-in-alt"></i>
			LOGIN
		</div>
		<div class="card-body card_body p-2">
			<form method="POST" action="{{ route('login') }}">
				@csrf

				<div class="row">
	         	<div class="col px-2">
	            	<div class="form-group mb-2">
							<input id="login" type="text"
								class="form-control form-control-sm {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
								name="login" value="{{ old('username') ?: old('email') }}" placeholder="Username / Email" required autofocus>
								@if ($errors->has('username') || $errors->has('email'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
									</span>
								@endif
						</div>

						<div class="form-group mb-2">
							<input type="password" class="form-control form-control-sm" id="pwd" name="password" placeholder="Password">
								@if ($errors->has('password'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
						</div>
				
						<div class="form-group mb-0">
							<button type="submit" class="btn btn-sm btn-block btn-primary">Log In</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endguest