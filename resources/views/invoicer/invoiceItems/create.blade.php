@extends('layouts.invoicer.app')

@section('content')

	{!! Form::open(array('route'=>'invoiceItems.store')) !!}
		{{ Form::token() }}
		{{ Form::hidden ('invoice_id', $invoice->id) }}

		<div class="card">
			
			<div class="card-header">
				<span class="h3">Add Billable Item to Invoice : {{ $invoice->id }}</span>
				<span class="float-right">
					<a href="{{ route('invoicer.invoices.edit', $invoice->id) }}" class="btn btn-sm btn-outline-secondary">
						<i class="fa fa-backward"></i>
						Cancel
					</a>
					{{ Form::button('<i class="fa fa-save"></i> Add Billable', ['class' => 'btn btn-sm btn-primary', 'type' => 'submit']) }}
				</span>
			</div>
			
			<div class="card-body">
				<div class="row">
					<div class="col-sm-8">
						<div class="form-group {{ $errors->has('product_id') ? 'has-error' : '' }}">
							{{ Form::label('product_id', 'Product', ['class'=>'required']) }}
							{{ Form::select('product_id', $products, [], ['class'=>'form-control', 'autofocus', 'placeholder'=>'Select']) }}
							<span class="text-danger">{{ $errors->first('product') }}</span>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
							{{ Form::label ('quantity', 'Quantity', ['class'=>'required']) }}
							{{ Form::text ('quantity', null, ['class'=>'form-control']) }}
							<span class="text-danger">{{ $errors->first('quantity') }}</span>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
							{{ Form::label ('price', 'Price', ['class'=>'required']) }}
							<div class="input-group">
								{{ Form::text ('price', null, ['class'=>'form-control text-right']) }}
								<div class="input-group-append">
									<span class="input-group-text">$</span>
								</div>
							</div>
							<span class="text-danger">{{ $errors->first('price') }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">
						<div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
							{{ Form::label ('notes', 'Notes:') }}
							{{ Form::textarea ('notes', null, array('class'=>'form-control')) }}
							<span class="text-danger">{{ $errors->first('notes') }}</span>
							<small id="passwordHelpBlock" class="form-text text-muted">
								These notes will be shown on the invoice
							</small>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group {{ $errors->has('work_date') ? 'has-error' : '' }}">
							{{ Form::label ('work_date', 'Work Date:', ['class'=>'required'])}}
							<div class="input-group">
								{{ Form::date ('work_date', null, array('class'=>'form-control')) }}
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="far fa-calendar-alt"></i>
									</span>
								</div>
							</div>
							<span class="text-danger">{{ $errors->first('work_date') }}</span>
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
