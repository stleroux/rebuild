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
         <div class="card mb-3">
            <div class="card-header card_header p-2">
               Edit Post
               <div class="float-right">
                  <div class="btn-group">
                     @if($post->image)
                        {{-- @include('posts.buttons.deleteImage', ['size'=>'xs']) --}}
                     @endif
                     @include('posts.buttons.back', ['size'=>'xs'])
                     @include('posts.buttons.update', ['size'=>'xs'])
                  </div>
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
                  <div class="col-xs-12 col-sm-6 col-md-2">
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
               </div>

               <div class="row">
                  <div class="col">
                     <div class="form-group {{ $errors->has('tag') ? 'has-error' : '' }}">
                        {{ Form::label('tags', 'Tags') }}<br />
                        <select class="selectpicker w-100" data-style="btn-sm btn-light" id="tags" name="tags[]" multiple>
                           @foreach($tags as $tag)
                              <option value="{{$tag->id}}" {{$post->tags->contains($tag->id)?"selected='selected":""}}>{{$tag->name}}</option>
                           @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('tag') }}</span>
                     </div>
                  </div>
               </div>
            
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                        {{ Form::label ('body', 'Body', ['class' => 'required']) }}
                        {{ Form::textarea ('body', null, ['class' => 'form-control form-control-sm wysiwyg', 'id'=>'wysiwyg']) }}
                        <span class="text-danger">{{ $errors->first('body') }}</span>
                     </div>
                  </div>
               </div>

               <!-- Image -->
               <div class="row">
                  <div class="col-xs-6 col-sm-2">
                     <table width="100%">
                        <tr>
                           <th>Current Image</th>
                        </tr>
                        <tr>
                           <td>
                              @if ($post->image)
                                 {{ Html::image("_posts/" . $post->image, "", array('height'=>'100','width'=>'100')) }}
                              @else
                                 <i class="fa fa-5x fa-ban"></i>
                              @endif
                           </td>
                        </tr>
                     </table>
                  </div>

                  <div class="col-xs-6 col-sm-3">
                     {!! Form::label("image", "Replace Image") !!}
                     {{ Form::file('image', ['class'=>'form-control form-control-sm p-0']) }}
                     <span class="help-block">Only choose new image to replace the existing one.</span>
                  </div>
{{--                      <div class="col-md-3">
                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                           {{ Form::label ('image', 'Update image') }}
                           {{ Form::file('image', ['class'=>'', 'value'=>'Image']) }}
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>
                     </div> --}}
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
      $(document).ready( function () {
         $(function () {
            $('.selectpicker').selectpicker({
               // style: "btn-default btn-sm"
            });
         });
      });
   </script>
@endsection