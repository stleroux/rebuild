@extends('layouts.master')

@section ('stylesheets')
	{{ Html::style('css/woodbarn.css') }}
   <link rel="stylesheet" href="/css/bootstrap-select.css">
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.posts.sidebar')
@endsection

@section('content')

	{!! Form::open(['route' => 'admin.posts.store', 'files'=>'true']) !!}

		<div class="card mb-3">
			<div class="card-header section_header p-2">
				New Post
				<div class="float-right">
               <div class="btn-group">
   					@include('admin.posts.buttons.back', ['size'=>'xs'])
	  			    @include('admin.posts.buttons.reset', ['size'=>'xs'])
		 			@include('admin.posts.buttons.save', ['size'=>'xs'])
               </div>
		  		</div>
			</div>

			<div class="card-body section_body p-2">
            @include('admin.posts.form')
         </div>
      </div>

  	{!! Form::close() !!}

@endsection

@section ('scripts')
	<script type="text/javascript" src="/js/bootstrap-select.js"></script>
	
	{{-- <script type="text/javascript">
      $(function () {
         $('.selectpicker').selectpicker({
            style: "btn-light btn-sm"
         });
      });
	</script> --}}
@endsection














   	  		{{-- <div class="row">
			 		<div class="col-6">
						<div class="form-group">
				  			{{ Form::label ('title', 'Title', ['class'=>'required'])}}
				  			{{ Form::text ('title', null, array('class' => 'form-control form-control-sm', 'autofocus'=>'autofocus')) }}
				  			<div class="pl-1 bg-danger">{{ $errors->first('title') }}</div>
						</div>
			 		</div>

               <!-- Category -->
               <div class="col-xs-12 col-sm-6 col-md-3">
                  <div class="form-group">
                     {!! Form::label('category_id', 'Category', ['class'=>'required']) !!}
                     <select name="category_id" id="category_id" class="form-control form-control-sm">
                        <option value="" selected>Select One</option>
                        @foreach ($categories as $category)
                           <option disabled>{{ ucfirst($category->name) }}</option>
                           @foreach ($category->children as $children)
                              <option value="{{ $children->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ ucfirst($children->name) }}</option>
                           @endforeach
                        @endforeach
                     </select>
                     <div class="pl-1 bg-danger">{{ $errors->first('category_id') }}</div>
                  </div>
               </div>
				 	<div class="col-3">
						<div class="form-group">
					  		{{ Form::label ('image', 'Upload image') }}
					  		{{ Form::file('image', ['class'=>'form-control form-control-sm', 'value'=>'Image']) }}
					  		<div class="pl-1 bg-danger">{{ $errors->first('image') }}</div>
						</div>
			 		</div>
   		 	</div> --}}
			 	
			 	{{-- <div class="row">
			 		<div class="col">
						<div class="form-group">
							{{ Form::label('tag_id', 'Tags') }}
							<select class="selectpicker w-100" id="tags" name="tags[]" multiple>
								@foreach ($tags as $tag)
									<option value="{{ $tag->id }}">{{ $tag->name }}</option>
								@endforeach
							</select>
							<div class="pl-1 bg-danger">{{ $errors->first('tag') }}</div>
						</div>
					</div>
				</div> --}}

			 	{{-- <div class="row">
		 			<div class="col-md-12">
						<div class="form-group">
				  			{{ Form::label ('body', 'Body', ['class'=>'required']) }}
				  			{{ Form::textarea ('body', null, array('class' => 'form-control form-control-sm wysiwyg')) }}
				  			<div class="pl-1 bg-danger">{{ $errors->first('body') }}</div>
						</div>
			 		</div>
			 	</div> --}}