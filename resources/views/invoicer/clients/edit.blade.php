@extends('layouts.invoicer.app')

@section('content')

	{!! Form::model($client, ['route'=>['invoicer.clients.update', $client->id], 'method' => 'PUT']) !!}
		{{ Form::token() }}

		<div class="card">
			
			<div class="card-header">
				<span class="h3">Edit Client</span>
				<span class="float-right">
					<a href="{{ route('invoicer.clients') }}" class="btn btn-sm btn-outline-secondary">
						<i class="fa fa-backward"></i>
						Cancel
					</a>
					{{ Form::button('<i class="fa fa-save"></i> Update Client', ['class' => 'btn btn-sm btn-primary', 'type' => 'submit']) }}
				</span>
			</div>
			
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12 col-md-8">
						<div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
							{{ Form::label ('company_name', 'Company Name:', ['class'=>'required'])}}
							{{ Form::text ('company_name', null, array('class'=>'form-control', 'autofocus')) }}
							<span class="text-danger">{{ $errors->first('company_name') }}</span>
						</div>
						<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
							{{ Form::label ('address', 'Address:')}}
							{{ Form::text ('address', null, array('class'=>'form-control')) }}
							<span class="text-danger">{{ $errors->first('address') }}</span>
						</div>

						<div class="row">
							<div class="col-sm-12 col-sm-6">
								<div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
									{{ Form::label ('city', 'City:')}}
									{{ Form::text ('city', null, array('class'=>'form-control')) }}
									<span class="text-danger">{{ $errors->first('city') }}</span>
								</div>
							</div>
							<div class="col-sm-12 col-sm-3">
								<div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
									{{ Form::label ('state', 'Province:')}}
									{{ Form::text ('state', null, array('class'=>'form-control')) }}
									<span class="text-danger">{{ $errors->first('state') }}</span>
								</div>
							</div>
							<div class="col-sm-12 col-sm-3">
								<div class="form-group {{ $errors->has('zip') ? 'has-error' : '' }}">
									{{ Form::label ('zip', 'Postal Code:')}}
									{{ Form::text ('zip', null, array('class'=>'form-control')) }}
									<span class="text-danger">{{ $errors->first('zip') }}</span>
								</div>
							</div>
							{{-- <div class="row"> --}}
							<div class="col-sm-12">
								
								<div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
									{{ Form::label ('notes', 'Notes:')}}
									{{ Form::textarea ('notes', null, array('class'=>'form-control', 'rows'=>4)) }}
									<span class="text-danger">{{ $errors->first('notes') }}</span>
								</div>
								{{-- </div> --}}
							</div>
						</div>
					</div>

					<div class="col-sm-12 col-md-4">
						<div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
							{{ Form::label ('contact_name', 'Contact Name:', ['class'=>'required'])}}
							{{ Form::text ('contact_name', null, array('class'=>'form-control')) }}
							<span class="text-danger">{{ $errors->first('contact_name') }}</span>
						</div>
						<div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
							{{ Form::label ('telephone', 'Telephone:')}}
							{{ Form::text ('telephone', null, array('class'=>'form-control')) }}
							<span class="text-danger">{{ $errors->first('telephone') }}</span>
						</div>
						<div class="form-group {{ $errors->has('cell') ? 'has-error' : '' }}">
							{{ Form::label ('cell', 'Cell:')}}
							{{ Form::text ('cell', null, array('class'=>'form-control')) }}
							<span class="text-danger">{{ $errors->first('cell') }}</span>
						</div>
						<div class="form-group {{ $errors->has('fax') ? 'has-error' : '' }}">
							{{ Form::label ('fax', 'Fax:')}}
							{{ Form::text ('fax', null, array('class'=>'form-control')) }}
							<span class="text-danger">{{ $errors->first('fax') }}</span>
						</div>
						<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							{{ Form::label ('email', 'Email Address:', ['class'=>'required'])}}
							{{ Form::text ('email', null, array('class'=>'form-control')) }}
							<span class="text-danger">{{ $errors->first('email') }}</span>
						</div>
						<div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">
							{{ Form::label ('website', 'Website Address:')}}
							{{ Form::text ('website', null, array('class'=>'form-control')) }}
							<span class="text-danger">{{ $errors->first('website') }}</span>
						</div>
					</div>
				</div>
			</div>

			<div class="card-footer">
				Fields marked with an<span class="required"></span> are required.
			</div>
			
		</div>
	{!! Form::close() !!}

@endsection
