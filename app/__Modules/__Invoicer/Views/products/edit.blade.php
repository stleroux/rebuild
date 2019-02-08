@extends('Invoicer::layouts.app')

@section('content')

	{!! Form::model($product, ['route'=>['invoicer.products.update', $product->id], 'method' => 'PUT']) !!}
		{{ Form::token() }}

		<div class="card">
			
			<div class="card-header">
				Edit Product
				<span class="float-right">
					<a href="{{ route('invoicer.products') }}" class="btn btn-xs btn-outline-secondary">
						<i class="fa fa-backward"></i>
						Cancel
					</a>
					{{ Form::button('<i class="fa fa-save"></i> Update Product', ['class' => 'btn btn-xs btn-primary', 'type' => 'submit']) }}
				</span>
			</div>
			
			<div class="card-body">
				<div class="row">
					<div class="col-xs-12 col-sm-8">
						<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
							{{ Form::label ('code', 'Code:')}}
							{{ Form::text ('code', null, array('class'=>'form-control', 'autofocus')) }}
							<span class="text-danger">{{ $errors->first('code') }}</span>
						</div>
						<div class="form-group {{ $errors->has('details') ? 'has-error' : '' }}">
							{{ Form::label ('details', 'Details:')}}
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
