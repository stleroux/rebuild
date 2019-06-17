@extends('layouts.invoicer.app')

@section('content')

	{!! Form::open(array('route'=>'invoicer.products.store')) !!}
		{{ Form::token() }}

		<div class="card">
			
			<div class="card-header">
				<span class="h3">Create New Product</span>
				<span class="float-right">
					<a href="{{ route('invoicer.products') }}" class="btn btn-sm btn-outline-secondary">
						<i class="fa fa-backward"></i>
						Cancel
					</a>
					{{ Form::button('<i class="fa fa-save"></i> Save Product', ['class' => 'btn btn-sm btn-primary', 'type' => 'submit']) }}
				</span>
			</div>
			
			<div class="card-body">
				<div class="row">
					<div class="col-xs-12 col-sm-3">
						<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
							{{ Form::label ('code', 'Code:', ['class'=>'required']) }}
							{{ Form::text ('code', null, array('class'=>'form-control', 'autofocus')) }}
							<span class="text-danger">{{ $errors->first('code') }}</span>
						</div>
					</div>
					<div class="col-xs-12 col-sm-9">
						<div class="form-group {{ $errors->has('details') ? 'has-error' : '' }}">
							{{ Form::label ('details', 'Details:', ['class'=>'required'])}}
							{{ Form::text ('details', null, array('class'=>'form-control')) }}
							<span class="text-danger">{{ $errors->first('details') }}</span>
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
