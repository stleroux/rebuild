@extends('layouts.master')

@section('content')

	{!! Form::model($user, ['route'=>['profile.accountPost', $user->id], 'method'=>'POST']) !!}

		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header card_header">
						Account Info
						<span class="float-right">
							{{ Form::button('<i class="fa fa-save"></i> Update Account', array('type'=>'submit', 'class'=>'btn btn-sm btn-outline-secondary px-1 py-0')) }}
						</span>
					</div>

					<div class="card-body card_body">
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
									<label for="username">Username</label>
									<input id="username" type="text" class="form-control form-control-sm" name="username" readonly="readonly" value="{{ $user->username }}">
								</div>

								<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
									<label for="email">Email</label>
									<input id="email" type="text" class="form-control form-control-sm" name="email" value="{{ $user->email }}">
									@if ($errors->has('email'))
										<span class="text-danger">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>

								<div class="form-group{{ $errors->has('public_email') ? ' has-error' : '' }}">
									<label for="public_email">Public Email</label>
									{{ Form::select('public_email', ['No','Yes'], null, ['class'=>'form-control form-control-sm']) }}
									<span class="form-text text-muted">Do you want to show your email address to all users?</span>
								</div>

								<div class="form-group{{ $errors->has('login_count') ? ' has-error' : '' }}">
									<label for="login_count">Login Count</label>
									<input id="login_count" type="text" class="form-control form-control-sm" name="login_count" readonly="readonly" value="{{ $user->login_count }}">
								</div>

								<div class="form-group{{ $errors->has('created_at') ? ' has-error' : '' }}">
									<label for="created_at">Created On</label>
									@if($user->created_at)
										<input id="created_at" type="text" class="form-control form-control-sm" name="created_at" readonly="readonly" value="{{ $user->created_at }}">
									@else
										<input id="created_at" type="text" class="form-control form-control-sm" name="created_at" readonly="readonly" value="Unknown">
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	{{ Form::close() }}
@endsection

@section('scripts')
	<script>
		//redirect to specific tab
		$(document).ready(function () {
			$('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
		});
	</script>
@endsection