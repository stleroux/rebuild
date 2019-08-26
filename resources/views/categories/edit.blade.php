@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
	@include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')
	
	{!! Form::model($category, ['route'=>['categories.update', $category->id], 'method' => 'PUT']) !!}
		{{ Form::token() }}

		<div class="row">
			<div class="col">
				<div class="card">
					<!--CARD HEADER-->
					<div class="card-header section_header p-2">
						<i class="fa fa-sitemap" aria-hidden="true"></i>
						Edit Category
						<span class="float-right">
							<div class="btn-group">
								@include('categories.buttons.help', ['size'=>'xs', 'bookmark'=>'categories_edit_category'])
								@include('categories.buttons.back', ['size'=>'xs'])
								@include('categories.buttons.reset', ['size'=>'xs'])
								@include('categories.buttons.update', ['size'=>'xs'])
							</div>
						</span>
					</div>

					<div class="card-body section_body p-2">
						<div class="row">
							<div class="col-3">
								<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
									{{ Form::label('name', 'Name', ['class'=>'required']) }}
									{{ Form::text('name', null, ['class' => 'form-control form-control-sm', 'autofocus', "onfocus"=>"this.focus();this.select()"]) }}
									<span class="text-danger">{{ $errors->first('name') }}</span>
								</div>
							</div>
							<div class="col-3">
								<div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
									{{ Form::label('value', 'Value') }}
									{{ Form::text('value', null, ['class' => 'form-control form-control-sm']) }}
									<span class="text-danger">{{ $errors->first('value') }}</span>
								</div>
							</div>
{{-- 							<div class="col">
								<div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
									{{ Form::label('module_id', 'Module', ['class'=>'required']) }}
									{{ Form::select('module_id', array(''=>'Select a module') + $modules, null, ['class'=>'form-control form-control-sm']) }}
									<span class="text-danger">{{ $errors->first('module_id') }} </span>
								</div>
							</div> --}}
							<div class="w-100"></div>
							<div class="col">
								<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
									{{ Form::label('description', 'Description') }}
									{{ Form::textarea('description', null, ['class' => 'form-control input-sm', 'rows'=>3]) }}
									<span class="text-danger">{{ $errors->first('description') }}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			
			{{-- <div class="col-xs-12 col-sm-3"> --}}
				{{-- @include('categories.edit.controls') --}}
				{{-- @include('block_info', ['model'=>$category, 'title'=>'Categories']) --}}
			{{-- </div> --}}
		{{-- </div> --}}

	{!! Form::close() !!}
	
@stop

@section ('scripts')
@stop