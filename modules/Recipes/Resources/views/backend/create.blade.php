@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
   @include('blocks.adminNav')
   @include('recipes::backend.sidebar')
@endsection

@section('right_column')
   {{-- @include('recipes::create.controls') --}}
@endsection

@section('content')
   {!! Form::open(['route' => 'recipes.store', 'files'=>'true']) !!}
      <div class="card mb-3">
         <div class="card-header">
            <i class="fa fa-plus-square"></i>
            Create Recipe
            <span class="float-right">
               @include('common.buttons.help', ['model'=>'recipe', 'bookmark'=>'recipes'])
               @include('common.buttons.cancel', ['model'=>'recipe', 'type'=>''])
               @include('common.buttons.save', ['model'=>'recipe', 'type'=>''])
            </span>
         </div>

         <div class="card-body">
            <div class="row">
               <!-- Title -->
               <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}" >
                     {!! Form::label("title", "Title", ['class'=>'required']) !!}
                     {{ Form::text ('title', null, array('class' => 'form-control', 'autofocus'=>'autofocus')) }}
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                  </div>
               </div>

               <!-- Category -->
               <div class="col-xs-12 col-sm-6 col-md-3">
                  <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}" >
                     {!! Form::label("category_id", "Category", ['class'=>'required']) !!}
                     {{-- <span class="float-right small">
                        <a href="#" class="small" data-toggle="modal" tabindex="-1" data-target=".addCategoryModal">Add Category</a>
                     </span> --}}
                     <select name="category_id" id="catSelect" class="custom-select">
                        <option selected>Select One</option>
                        @foreach ($categories as $category)
                           <option disabled>{{ ucfirst($category->name) }}</option>
                           @foreach ($category->children as $children)
                              <option value="{{ $children->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ ucfirst($children->name) }}</option>
                           @endforeach
                        @endforeach
                     </select>
                  </div>
               </div>

               <!-- Publish Date -->
               <div class="col-xs-12 col-sm-6 col-md-3">
                  <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
                     {{ Form::label('published_at', 'Publish(ed) On') }}
                     <div class="input-group">
                        <input type="text" name="published_at" class="form-control" id="datePicker" />
                        <div class="input-group-append">
                           <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                     </div>
                     <span class="text-danger">{{ $errors->first('published_at') }}</span>
                  </div>
               </div>

               <!-- Ingredients -->
               <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group {{ $errors->has('ingredients') ? 'has-error' : '' }}">
                     {{ Form::label('ingredients', 'Ingredients', ['class'=>'required']) }} <small>(One per line)</small>
                     {{ Form::textarea ('ingredients', null, array('class' => 'form-control simple', 'rows'=>'5')) }}
                     <span class="text-danger">{{ $errors->first('ingredients') }}</span>
                  </div>
               </div>

               <!-- Methodology -->
               <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group {{ $errors->has('methodology') ? 'has-error' : '' }}">
                     {{ Form::label('methodology', 'Methodology', ['class'=>'required']) }} <small>(One per line)</small>
                     {{ Form::textarea ('methodology', null, array('class' => 'form-control simple', 'rows'=>'5')) }}
                     <span class="text-danger">{{ $errors->first('methodology') }}</span>
                   </div>
               </div>

               <!-- Servings -->
               <div class="col-xs-6 col-md-3 col-lg-2">
                  <div class="form-group {{ $errors->has('servings') ? 'has-error' : '' }}" >
                     {{ Form::label("servings", "Servings", ['class'=>'required']) }}
                     {{ Form::number ('servings', null, array('class' => 'form-control')) }}
                     <span class="text-danger">{{ $errors->first('servings') }}</span>
                  </div>
               </div>

               <!-- Prep Time -->
               <div class="col-xs-6 col-md-3 col-lg-2">
                  <div class="form-group {{ $errors->has('prep_time') ? 'has-error' : '' }}" >
                     {{ Form::label("prep_time", "Prep Time", ['class'=>'required']) }}
                     {{ Form::number ('prep_time', null, array('class' => 'form-control', 'placeholder'=>'minutes')) }}
                     <span class="text-danger">{{ $errors->first('prep_time') }}</span>
                  </div>
               </div>

               <!-- Cook Time -->
               <div class="col-xs-6 col-md-3 col-lg-2">
                  <div class="form-group {{ $errors->has('cook_time') ? 'has-error' : '' }}" >
                     {{ Form::label("cook_time", "Cook Time", ['class'=>'required']) }}
                     {{ Form::number ('cook_time', null, array('class' => 'form-control', 'placeholder'=>'minutes')) }}
                     <span class="text-danger">{{ $errors->first('cook_time') }}</span>
                  </div>
               </div>

               <!-- Make Private -->
               <div class="col-xs-6 col-md-3 col-lg-2">
                  <div class="form-group">
                     {!! Form::label("personal", "Make Private") !!}
                     {{ Form::select('personal', array('0' => 'No', '1' => 'Yes'), 0, ['class'=>'form-control']) }}
                  </div>
               </div>

               <!-- Public Notes -->
               <div class="col-xs-12 col-md-6">
                  <div class="form-group">
                     {!! Form::label("public_notes", "Public Notes") !!}
                     {{ Form::textarea ('public_notes', null, array('class' => 'form-control simple', 'rows'=>'2')) }}
                  </div>
               </div>

               <!-- Author's Notes -->
               <div class="col-xs-12 col-md-6">
                  <div class="form-group">
                     {!! Form::label("private_notes", "Author's Personal Notes") !!} <small>(not shown to public)</small>
                     {{ Form::textarea ('private_notes', null, array('class' => 'form-control simple', 'rows'=>'2')) }}
                  </div>
               </div>

               <!-- Source -->
               <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                     {!! Form::label("source", "Source") !!}
                     {{ Form::text ('source', null, array('class' => 'form-control')) }}
                  </div>
               </div>

               <!-- Image -->
               <div class="col-xs-6 col-sm-3">
                  {!! Form::label("image", "Image") !!} <small></small>
                  {{ Form::file('image', ['class'=>'form-control']) }}
               </div>
            </div>
         </div>
      </div>
   {!! Form::close() !!}


<div class="modal fade addCategoryModal" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Add New Category</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
 
         {{-- {!! Form::open(['url'=>'categories/saveModal', 'class'=>'', 'method'=>'GET']) !!} --}}
         {!! Form::open(['route' => 'categories.saveModal']) !!}
            {{ csrf_field() }}
         {{-- {!! Form::open(route('categories.addModal'), ['class'=>'myForm-waterSource']) !!} --}}
            <div class="modal-body">
               {{-- <input type="text" id="parent_id" value="1"> --}}
               <div class="form-group {{ $errors->has('cCategory') ? 'has-error' : '' }}">
                     {!! Form::label('cCategory','Main Category', ['class'=>'required']) !!}
                     <select name="cCategory" id="category" class="form-control input-sm">
                        <option value="">Select One</option>
                        @foreach($categories as $k)
                           <option value="{{ $k['id'] }}">{{ ucwords($k['name']) }}</option>
                        @endforeach
                     </select>
                     <span class="text-danger">{{ $errors->first('cCategory') }} </span>
                  </div>

               <div class="form-group">
                  {!! Form::text('name',null,['class'=>'input form-control','id'=>'name','autofocus'=>'autofocus']) !!}
               </div>
            </div>
 
            <div class="modal-footer">
               <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
               {!! Form::submit('Submit',['class'=>'btn btn-sm btn-primary']) !!}
            </div>
         {!! Form::close() !!}
      </div>
   </div>
</div>


@endsection

@section('scripts')

@endsection