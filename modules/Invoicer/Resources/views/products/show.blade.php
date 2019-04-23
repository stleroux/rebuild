@extends('invoicer::layouts.app')

@section('content')

		<div class="card">
			
			<div class="card-header">
				Product Information
				<span class="float-right">
					<a href="{{ route('invoicer.products') }}" class="btn btn-sm btn-primary">
						<i class="fa fa-list"></i>
						Products List
					</a>
				</span>
			</div>
			
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							{{ Form::label ('code', 'Code:')}}
							{{ Form::text ('code', $product->code, array('class'=>'form-control', 'readonly')) }}
						</div>
						<div class="form-group">
							{{ Form::label ('details', 'Details:')}}
							{{ Form::text ('details', $product->details, ['class'=>'form-control', 'readonly']) }}
						</div>
					</div>
				</div>
			</div>
		</div>

@endsection
