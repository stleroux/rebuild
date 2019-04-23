@extends('invoicer::layouts.app')

@section('content')

	{!! Form::open(array('route'=>'invoicer.invoices.store')) !!}
		{{ Form::token() }}

		<div class="card">
			
			<div class="card-header">
				Create New Invoice
				<span class="float-right">
					<a href="{{ route('invoicer.invoices') }}" class="btn btn-sm btn-outline-secondary">
						<i class="fas fa-backward"></i>
						Cancel
					</a>
					{{ Form::button('<i class="fa fa-save"></i> Save Invoice', ['class' => 'btn btn-sm btn-primary', 'type' => 'submit']) }}
				</span>
			</div>
			
			<div class="card-body">
				<div class="row">
					<div class="col-md-9">
						<div class="form-group {{ $errors->has('client_id') ? 'has-error' : '' }}">
							{{ Form::label('client_id', 'Client', ['class'=>'required']) }}
							@if(!empty($client))
								{{ Form::select('client_id', $clients, [$client->id], ['class'=>'form-control', 'placeholder'=>'Select']) }}
							@else
								{{ Form::select('client_id', $clients, [], ['class'=>'form-control', 'placeholder'=>'Select']) }}
							@endif

							
							<span class="text-danger">{{ $errors->first('client_id') }}</span>
						</div>
						<div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
							{{ Form::label ('notes', 'Notes:') }}
							{{ Form::textarea ('notes', null, ['class'=>'form-control', 'rows'=>'4']) }}
							<span class="text-danger">{{ $errors->first('notes') }}</span>
							<small id="passwordHelpBlock" class="form-text text-muted">
								These notes will not be shown on the invoice
							</small>
						</div>
					</div>
					<div class="col-md-3">
						{{-- <div class="form-group {{ $errors->has('work_date') ? 'has-error' : '' }}">
							{{ Form::label ('work_date', 'Work Date:', ['class'=>'required'])}}
							<div class="input-group">
								{{ Form::date ('work_date', null, array('class'=>'form-control')) }}
								<div class="input-group-addon">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</div>
							</div>
							<span class="text-danger">{{ $errors->first('work_date') }}</span>
						</div> --}}

						<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
							{{ Form::label ('status', 'Status', ['class'=>'required']) }}
							{{ Form::select('status', ['logged'=>'Logged', 'invoiced'=>'Invoiced', 'paid'=>'Paid'], null, ['placeholder'=>'Pick one...', 'class'=>'form-control']) }}
							<span class="text-danger">{{ $errors->first('status') }}</span>
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
