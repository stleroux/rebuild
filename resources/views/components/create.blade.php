@extends('layouts.master')

@section('left_column')
   {{-- @include('blocks.admin_menu') --}}
   @include('components.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

	{!! Form::open(array('route' => 'components.store', 'method'=>'POST')) !!}
		<div class="card">
			
			<div class="card-header card_header">
				<i class="fas fa-boxes"></i>
				New Component
				<div class="float-right">
					<a href="{{ route('components.index') }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
						<i class="fas fa-angle-double-left"></i>
						Cancel
					</a>
					{{ Form::button('<i class="fa fa-save"></i> Save ', ['type'=>'submit', 'class'=>'btn btn-sm btn-outline-success px-1 py-0'])  }}
				</div>
			</div>
			
			<div class="card-body card_body">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							{{ Form::label('name', 'Name', ['class'=>'required']) }}
							{!! Form::text('name', null, array('placeholder' => 'Name','class'=>'form-control form-control-sm', 'autofocus'=>'autofocus')) !!}
							<span class="text-danger">{{ $errors->first('name') }}</span>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group {{ $errors->has('seed') ? 'has-error' : '' }}">
							{{ Form::label('seed', 'Seed', ['class'=>'required']) }}
							{{ Form::select('seed', [ '0' => 'No', '1' => 'Yes'], 0, ['class'=>'form-control form-control-sm']) }}
							<small class="form-text">Populate database table with test data? (Not implemented yet)</small>
							<span class="text-danger">{{ $errors->first('seed') }}</span>
						</div>
					</div>
				</div>
			</div>

			<div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>
         
		</div>
	{!! Form::close() !!}

@endsection