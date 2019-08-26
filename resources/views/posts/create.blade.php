@extends('layouts.master')

@section ('stylesheets')
	{{ Html::style('css/woodbarn.css') }}
   <link rel="stylesheet" href="/css/bootstrap-select.css">
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')

	{!! Form::open(['route' => 'posts.store', 'files'=>'true']) !!}
		<div class="card mb-3">
			<div class="card-header card_header py-1">
				New Post
				<div class="float-right">
               <div class="btn-group">
   					@include('posts.buttons.back', ['size'=>'xs'])
	  			      @include('posts.buttons.reset', ['size'=>'xs'])
		 			   @include('posts.buttons.save', ['size'=>'xs'])
               </div>
		  		</div>
			</div>

			<div class="card-body card_body">
   	  		<div class="row">
			 		<div class="col-6">
						<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
				  			{{ Form::label ('title', 'Title', ['class'=>'required'])}}
				  			{{ Form::text ('title', null, array('class' => 'form-control form-control-sm', 'autofocus'=>'autofocus')) }}
				  			<span class="text-danger">{{ $errors->first('title') }}</span>
						</div>
			 		</div>
               <!-- Category -->
               <div class="col-xs-12 col-sm-6 col-md-3">
                  <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}" >
                     {!! Form::label("category_id", "Category", ['class'=>'required']) !!}
                     <select name="category_id" class="form-control form-control-sm">
                        <option value="" selected>Select One</option>
                        @foreach ($categories as $category)
                           <option disabled>{{ ucfirst($category->name) }}</option>
                           @foreach ($category->children as $children)
                              <option value="{{ $children->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ ucfirst($children->name) }}</option>
                           @endforeach
                        @endforeach
                     </select>
                     <span class="text-danger">{{ $errors->first('category_id') }}</span>
                  </div>
               </div>
				 	<div class="col-3">
						<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
					  		{{ Form::label ('image', 'Upload image') }}
					  		{{ Form::file('image', ['class'=>'form-control form-control-sm', 'value'=>'Image']) }}
					  		<span class="text-danger">{{ $errors->first('image') }}</span>
						</div>
			 		</div>
   		 	</div>
			 	
			 	<div class="row">
			 		<div class="col">
						<div class="form-group {{ $errors->has('tag') ? 'has-error' : '' }}">
							{{ Form::label('tag_id', 'Tags') }}
							<select class="selectpicker w-100" id="tags" name="tags[]" multiple>
								@foreach ($tags as $tag)
									<option value="{{ $tag->id }}">{{ $tag->name }}</option>
								@endforeach
							</select>
							<span class="text-danger">{{ $errors->first('tag') }}</span>
						</div>
					</div>
				</div>

			 	<div class="row">
		 			<div class="col-md-12">
						<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
				  			{{ Form::label ('body', 'Body', ['class'=>'required']) }}
				  			{{ Form::textarea ('body', null, array('class' => 'form-control form-control-sm wysiwyg')) }}
				  			<span class="text-danger">{{ $errors->first('body') }}</span>
						</div>
			 		</div>
			 	</div>
		  	
         </div>
      </div>
  	{!! Form::close() !!}

@endsection

@section ('scripts')
	<script type="text/javascript" src="/js/bootstrap-select.js"></script>
	
	<script type="text/javascript">
      $(function () {
         $('.selectpicker').selectpicker({
            style: "btn-light btn-sm"
         });
      });
	</script>
@endsection
