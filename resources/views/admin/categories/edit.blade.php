@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
	{{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
@endsection

@section('content')
	
	<form>
		@method('PUT')
		@csrf

		<div class="row">
			<div class="col">
				<div class="card">
					<!--CARD HEADER-->
					<div class="card-header section_header p-2">
						<i class="fa fa-sitemap" aria-hidden="true"></i>
						Edit Category
						<span class="float-right">
							<div class="btn-group">
								@include('admin.categories.buttons.help', ['size'=>'xs', 'bookmark'=>'categories_edit_category'])
								@include('admin.categories.buttons.back', ['size'=>'xs'])
								@include('admin.categories.buttons.reset', ['size'=>'xs'])
								@include('admin.categories.buttons.update', ['size'=>'xs'])
							</div>
						</span>
					</div>

					<div class="card-body section_body p-2">
						<div class="row">
							<div class="col-3">
								<div class="form-group">
									<label for="name" class="required">Name</label>
									<input type="text" name="name" value="{{ $category->name }}" class="form-control form-control-sm" autofocus onfocus="this.focus();this.select()">
									<div class="pl-1 bg-danger">{{ $errors->first('name') }}</div>
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label for="value">Value</label>
									<input type="text" name="value" value="{{ $category->value }}" class="form-control form-control-sm">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col">
								<div class="form-group">
									<label for="description">Description</label>
									<textarea name="description" class="form-control form-control-sm" rows="3">{{ $category->description }}</textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			
	{!! Form::close() !!}
	
@endsection

@section ('scripts')
@endsection