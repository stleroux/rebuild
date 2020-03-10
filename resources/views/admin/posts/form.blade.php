<div class="form-row">

   <!-- TITLE -->
   <div class="col-6">
      <div class="form-group">
         {{ Form::label ('title', 'Title', ['class'=>'required'])}}
         {{ Form::text ('title', null, array('class' => 'form-control form-control-sm', 'autofocus'=>'autofocus')) }}
         <div class="pl-1 bg-danger">{{ $errors->first('title') }}</div>
      </div>
   </div>

   <!-- CATEGORY -->   
   <div class="col-12 col-sm-6 col-md-3">
      <div class="form-group">
         {!! Form::label('category_id', 'Category', ['class'=>'required']) !!}
         <select name="category_id" id="category_id" class="form-control form-control-sm">
            @if(last(request()->segments()) === 'create')
               <option value="" selected>Select One</option>
            @endif
            @foreach ($categories as $category)
               @if(last(request()->segments()) === 'create')
                  <option disabled>{{ ucfirst($category->name) }}</option>
               @endif
               @foreach ($category->children as $children)
                  @if(last(request()->segments()) === 'create')
                     <option value="{{ $children->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ ucfirst($children->name) }}</option>
                  @endif
                  @if(last(request()->segments()) === 'edit')
                     <option value="{{ $children->id }}" {{ ($post->category_id == $children->id ) ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ ucfirst($children->name) }}</option>
                  @endif
               @endforeach
            @endforeach
         </select>
         <div class="pl-1 bg-danger">{{ $errors->first('category_id') }}</div>
      </div>
   </div>

   <!-- PUBLISH DATE-->
   <div class="col-xs-12 col-sm-3 col-md-3">
      <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
         {{ Form::label('published_at', 'Publish(ed) On') }}
         <div class="input-group input-group-sm">
            <input type="text" name="published_at" value="{{ old('published_at') ?? $post->published_at }}" class="form-control form-control-sm" id="datePicker" />
            <div class="input-group-append">
               <span class="input-group-text input-group-text-sm"><i class="far fa-calendar-alt"></i></span>
            </div>
         </div>
         <div class="pl-1 bg-danger">{{ $errors->first('published_at') }}</div>
      </div>
   </div>

</div>

<div class="form-row">

   <!-- BODY -->
   <div class="col-md-12">
      <div class="form-group">
         {{ Form::label ('body', 'Body', ['class' => 'required']) }}
         {{ Form::textarea ('body', null, ['class' => 'form-control form-control-sm wysiwyg', 'id'=>'wysiwyg']) }}
         <div class="pl-1 bg-danger">{{ $errors->first('body') }}</div>
      </div>
   </div>

</div>

<div class="form-row">
   
   <!-- TAGS -->
   <div class="col">
      <div class="form-group">
         {{ Form::label('tag_id', 'Tags') }}
         <select class="selectpicker w-100" data-style="btn-sm btn-light" id="tags" name="tags[]" multiple>
            @foreach ($tags as $tag)
               @if(last(request()->segments()) === 'create')
                  <option value="{{ $tag->id }}">{{ $tag->name }}</option>
               @endif

               @if(last(request()->segments()) === 'edit')
                  <option value="{{$tag->id}}" {{$post->tags->contains($tag->id)?"selected='selected":""}}>{{$tag->name}}</option>               
               @endif
            @endforeach
         </select>
         <div class="pl-1 bg-danger">{{ $errors->first('tag') }}</div>
      </div>
   </div>

</div>

<div class="form-row">
   
   <!-- CURRENT IMAGE -->
   <div class="col-xs-6 col-sm-2">
      <table width="100%" class="table-bordered">
         <tr>
            <th>Current Image</th>
         </tr>
         <tr>
            <td>
               @if(last(request()->segments()) === 'edit' && $post->image)
                  {{ Html::image("_posts/" . $post->image, "", array('height'=>'100','width'=>'100')) }}
               @else
                  <i class="fa fa-5x fa-ban"></i>
               @endif
            </td>
         </tr>
      </table>
   </div>

   <!-- UPLOAD\UPDATE IMAGE -->
   <div class="col-md-3">
      <div class="form-group">
         {{ Form::label ('image', 'Update image') }}
         {{ Form::file('image', ['class'=>'', 'value'=>'Image']) }}
         <div class="pl-1 bg-danger">{{ $errors->first('image') }}</div>
         @if(last(request()->segments()) === 'edit')
            <div class="help-block">Only choose new image to replace the existing one.</div>
         @endif
      </div>
   </div>
   
</div>
