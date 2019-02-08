@extends('layouts.master')

@section('content')
	{!! Form::model($user, ['route'=>['profile.profilePost', $user->profile->id], 'method'=>'PUT', 'files'=>true]) !!}

	<div class="row">
	<div class="col">
		<div class="card mb-2">
			<div class="card-header card_header">
				Profile Information
				<span class="float-right">
					{{ Form::button('<i class="fa fa-save"></i> Update Profile', array('type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary px-1 py-0')) }}
				</span>
			</div>
			<div class="card-body card_body">
				<div class="row">
					<div class="col-sm-12 col-md-9 col-lg-4">
						<div class="card mb-2">
							
							<div class="card-header card_header_2">
								Personal Info
							</div>

							<div class="card-body card_body">
								<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
									<label for="first_name" class="required">First Name</label>
									
										<input id="first_name" type="text" class="form-control form-control-sm" name="first_name" value="{{ $user->profile->first_name }}" autofocus>
										@if ($errors->has('first_name'))
											<span class="help-block">{{ $errors->first('first_name') }}</span>
										@endif
									
								</div>

								<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
									<label for="last_name" class="required">Last Name</label>
									
										<input id="last_name" type="text" class="form-control form-control-sm" name="last_name" value="{{ $user->profile->last_name }}">
										@if ($errors->has('last_name'))
											<span class="help-block">{{ $errors->first('last_name') }}</span>
										@endif
									
								</div>

								<div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
									<label for="telephone" class="required">Telephone</label>
									
										<input id="telephone" type="text" class="form-control form-control-sm" name="telephone" value="{{ $user->profile->telephone }}">
										@if ($errors->has('telephone'))
											<span class="help-block">{{ $errors->first('telephone') }}</span>
										@endif
										{{-- <span class="help-block">For internal use only. Will not be shared with other users.</span> --}}
										<small id="" class="form-text">For internal use only. Will not be shared with other users.</small>
									
								</div>

							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-9 col-md-4">
						<div class="card mb-2">
							<div class="card-header card_header_2">
								Address Info
							</div>
							<div class="card-body card_body">

								<div class="form-group{{ $errors->has('civic_number') ? ' has-error' : '' }}">
									<label for="civic_number" class=" control-label">Civic/Unit N<sup>o</sup></label>
									
										<input id="civic_number" type="text" class="form-control form-control-sm" name="civic_number" value="{{ $user->profile->civic_number }}">
										@if ($errors->has('civic_number'))
											<span class="help-block">{{ $errors->first('civic_number') }}</span>
										@endif
									
								</div>

								<div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
									<label for="address1" class=" control-label">Address 1</label>
									
										<input id="address1" type="text" class="form-control form-control-sm" name="address1" value="{{ $user->profile->address1 }}">
										@if ($errors->has('address1'))
											<span class="help-block">{{ $errors->first('address1') }}</span>
										@endif
									
								</div>

								<div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
									<label for="address2" class=" control-label">Address 2</label>
									
										<input id="address2" type="text" class="form-control form-control-sm" name="address2" value="{{ $user->profile->address2 }}">
										@if ($errors->has('address2'))
											<span class="help-block">{{ $errors->first('address2') }}</span>
										@endif
									
								</div>

								<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
									<label for="city" class=" control-label">City</label>
									
										<input id="city" type="text" class="form-control form-control-sm" name="city" value="{{ $user->profile->city }}">
										@if ($errors->has('city'))
											<span class="help-block">{{ $errors->first('city') }}</span>
										@endif
									
								</div>

								<div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}">
									<label for="province" class=" control-label">Province/State</label>
									
										<input id="province" type="text" class="form-control form-control-sm" name="province" value="{{ $user->profile->province }}">
										@if ($errors->has('province'))
											<span class="help-block">{{ $errors->first('province') }}</span>
										@endif
									
								</div>

								<div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
									<label for="postal_code" class=" control-label">Postal/Zip Code</label>
									
										<input id="postal_code" type="text" class="form-control form-control-sm" name="postal_code" value="{{ $user->profile->postal_code }}">
										@if ($errors->has('postal_code'))
											<span class="help-block">{{ $errors->first('postal_code') }}</span>
										@endif
									
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-12 col-md-9 col-lg-4">
						<div class="card mb-2">

							<div class="card-header card_header_2">
								Profile Image
							</div>

							<div class="card-body card_body">
								<div class="text text-center">
									@if ($user->profile->image)
										{{ Html::image("_profiles/" . $user->profile->image, "",array('height'=>'115','width'=>'115')) }}
									@else
										<i class="fas fa-5x fa-user"></i>
									@endif
								</div>
								<br />
								{{-- {{ Form::file ('image' , ['class'=>'form-control form-control-sm']) }} --}}
								{{ Form::file('image', ['class'=>'border', 'value'=>'Image']) }}
							</div>

							<div class="card-footer p-1">
								@if($user->profile->image)
									<a href="{{ route('profile.deleteImage', $user->profile->id) }}" class="btn btn-sm btn-outline-danger px-1 py-0">Delete Image</a>
								@endif
							</div>

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