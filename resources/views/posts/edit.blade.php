@extends ('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
   <link rel="stylesheet" href="/css/bootstrap-select.css">
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('posts.sidebar')
@endsection

@section ('content')

{!! Form::model($post, ['route'=>['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
   
   <div class="row">
      <div class="col">
         <div class="card">
            <div class="card-header card_header p-2">
               Edit Post
               <div class="float-right">
                  @if($post->image)
                     @include('posts.buttons.deleteImage', ['size'=>'xs'])
                  @endif
                  @include('posts.buttons.cancel', ['size'=>'xs'])
                  @include('posts.buttons.update', ['size'=>'xs'])
               </div>
            </div>
            <div class="card-body card_body p-2">
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
                           <select name="category_id" class="form-control form-control-sm">
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
                           {{ Form::file('image', ['class'=>'', 'value'=>'Image']) }}
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
                     <div class="col-md-12">
                        <div class="form-group">
                           {{ Form::label('tag', 'Tags') }}
                           {{ Form::select('tags[]', $tags, null, ['class'=>'form-control form-control-sm selectpicker', 'multiple'=>'multiple']) }}
                        </div>
                     </div>
                  </div>

                  {{-- <div class="row">
                     <div class="col">
                        <div class="form-group {{ $errors->has('tag') ? 'has-error' : '' }}">
                           {{ Form::label('tag_id', 'Tags') }}
                           <select class="form-control form-control-sm selectpicker" id="tags" name="tags[]" multiple>
                              @foreach ($tags as $tag)
                                 <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                              @endforeach
                           </select>
                           <span class="text-danger">{{ $errors->first('tag') }}</span>
                        </div>
                     </div>
                  </div> --}}
            
                  <div class="row">
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

@endsection

@section ('scripts')
   <script type="text/javascript" src="/js/bootstrap-select.js"></script>
   
   <script type="text/javascript">
      $(function () {
         $('.selectpicker').selectpicker();
      });
   </script>
@endsection