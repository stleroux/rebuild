@extends ('layouts.backend')

@section ('stylesheets')
   {{ Html::style('css/posts.css') }}
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
@stop

@section('left_column')
   @include('blocks.adminNav')
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
                     @include('common.buttons.deleteImage', ['model'=>'post', 'id'=>$post->id, 'type'=>''])
                  @endif
                  @include('common.buttons.cancel', ['model'=>'post', 'type'=>''])
                  @include('common.buttons.update', ['model'=>'post', 'type'=>''])
               </div>
            </div>
            <div class="card-body card_body">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                           {{ Form::label ('title', 'Title', ['class'=>'required']) }}
                           {{ Form::text ('title', null, ['class' => 'form-control form-control-sm']) }}
                           <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                     </div>

                     <!-- Category -->
                     <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}" >
                           {!! Form::label("category_id", "Category", ['class'=>'required']) !!}
                           <select name="category_id" class="custom-select">
                              @foreach ($categories as $category)
                                 <option disabled>{{ ucfirst($category->name) }}</option>
                                 @foreach ($category->children as $children)
                                    <option value="{{ $children->id }}" {{ ($post->category_id == $children->id ) ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ ucfirst($children->name) }}</option>
                                 @endforeach
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                           {{ Form::label ('image', 'Update image') }}
                           {{ Form::file('image', ['class'=>'border', 'value'=>'Image']) }}
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     {{-- <div class="col-md-8">
                        <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                           {{ Form::label ('slug', 'Slug', ['class'=>'required']) }}
                           {{ Form::text ('slug', null, ['class' => 'form-control form-control-sm', 'readonly']) }}
                           <span class="text-danger">{{ $errors->first('slug') }}</span>
                        </div>
                     </div> --}}
                     
                  </div>
                  <div class="row">
                     <div class="col-md-6">
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