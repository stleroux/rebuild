@extends ('layouts.master')

@section ('stylesheets')
	{{ Html::style('css/posts.css') }}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
@stop

@section('left_column')
   {{-- @include('blocks.admin_menu') --}}
   @include('posts::sidebar')
@endsection

@section('right_column')
@endsection

@section ('content')

{!! Form::model($post, ['route'=>['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
	
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header card_header">
					Edit Post
					<div class="float-right">
						@if($post->image)
							<a href="{{ route('posts.deleteImage', $post->id) }}" class="btn btn-sm btn-outline-danger px-1 py-0">
								<i class="far fa-trash-alt"></i>
								Delete Image
							</a>
						@endif

						<a href="{{ route('posts.'. Session::get('pageName')) }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
							<i class="fas fa-angle-double-left"></i>
							Cancel
						</a>
						
						<button type="submit" class="btn btn-sm btn-outline-bprimary px-1 py-0">
							<i class="fa fa-save"></i>
							Update
						</button>
					</div>
				</div>
				<div class="card-body card_body">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									{{ Form::label ('title', 'Title', ['class'=>'required']) }}
									{{ Form::text ('title', null, ['class' => 'form-control form-control-sm']) }}
									<span class="text-danger">{{ $errors->first('title') }}</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
									{{ Form::label('category', 'Category', ['class'=>'required']) }}
									{{ Form::select('category_id', $categories, null, ['class'=>'form-control  form-control-sm']) }}
									<span class="text-danger">{{ $errors->first('category') }}</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
									{{ Form::label ('slug', 'Slug', ['class'=>'required']) }}
									{{ Form::text ('slug', null, ['class' => 'form-control form-control-sm', 'readonly']) }}
									<span class="text-danger">{{ $errors->first('slug') }}</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
									{{ Form::label ('image', 'Update image') }}
									{{ Form::file('image', ['class'=>'border', 'value'=>'Image']) }}
								<span class="text-danger">{{ $errors->first('image') }}</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									{{ Form::label('tag', 'Tags') }}
									{{ Form::select('tags[]', $tags, null, ['class'=>'form-control select2-multi', 'multiple'=>'multiple']) }}
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
									{{ Form::label ('body', 'Body', ['class' => 'required']) }}
									{{ Form::textarea ('body', null, ['class' => 'form-control form-control-sm wysiwyg', 'id'=>'wysiwyg']) }}
									<span class="text-danger">{{ $errors->first('body') }}</span>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
{!! Form::close() !!}

@stop

@section ('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	
	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>
@stop