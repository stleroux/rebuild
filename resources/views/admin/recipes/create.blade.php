@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.recipes.blocks.sidebar')
@endsection

@section('content')

   {!! Form::open(['route' => 'admin.recipes.store', 'files'=>'true']) !!}
      <div class="card mb-3">
         <div class="card-header section_header p-2">
            <i class="fa fa-plus-square"></i>
            Create Recipe
            <span class="float-right">
               <div class="btn-group">
                  @include('admin.recipes.buttons.help', ['size'=>'xs', 'bookmark'=>'recipes'])
                  @include('admin.recipes.buttons.back', ['size'=>'xs'])
                  @include('admin.recipes.buttons.save', ['size'=>'xs'])
               </div>
            </span>
         </div>

         <div class="card-body section_body p-2">
            <div class="form-row">
               <!-- Title -->
               <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                     {!! Form::label("title", "Title", ['class'=>'required']) !!}
                     {{ Form::text ('title', null, array('class' => 'form-control form-control-sm', 'autofocus'=>'autofocus')) }}
                     <div class="pl-1 bg-danger">{{ $errors->first('title') }}</div>
                  </div>
               </div>

               <!-- Category -->
               <div class="col-xs-12 col-sm-6 col-md-3">
                  <div class="form-group">
                     {!! Form::label("category_id", "Category", ['class'=>'required']) !!}
                     <select name="category_id" id="catSelect" class="form-control form-control-sm">
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

               <!-- Publish Date -->
               @if(checkperm('recipe_edit'))
                  <div class="col-xs-12 col-sm-6 col-md-3">
                     <div class="form-group">
                        {{ Form::label('published_at', 'Publish(ed) On') }}
                        <div class="input-group input-group-sm">
                           <input type="text" name="published_at" class="form-control form-control-sm" id="datePicker" />
                           <div class="input-group-append">
                              <span class="input-group-text input-group-text-sm"><i class="far fa-calendar-alt"></i></span>
                           </div>
                        </div>
                        <div class="pl-1 bg-danger">{{ $errors->first('published_at') }}</div>
                     </div>
                  </div>
               @endif

               <!-- Ingredients -->
               <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                     {{ Form::label('ingredients', 'Ingredients', ['class'=>'required']) }} <small>(One per line)</small>
                     {{ Form::textarea ('ingredients', null, array('class' => 'form-control form-control-sm simple', 'rows'=>'5')) }}
                     <div class="pl-1 bg-danger">{{ $errors->first('ingredients') }}</div>
                  </div>
               </div>

               <!-- Methodology -->
               <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                     {{ Form::label('methodology', 'Methodology', ['class'=>'required']) }} <small>(One per line)</small>
                     {{ Form::textarea ('methodology', null, array('class' => 'form-control form-control-sm simple', 'rows'=>'5')) }}
                     <div class="pl-1 bg-danger">{{ $errors->first('methodology') }}</div>
                   </div>
               </div>

               <!-- Servings -->
               <div class="col-xs-6 col-md-3 col-lg-2">
                  <div class="form-group">
                     {{ Form::label("servings", "Servings", ['class'=>'required']) }}
                     {{ Form::number ('servings', null, array('class' => 'form-control form-control-sm')) }}
                     <div class="pl-1 bg-danger">{{ $errors->first('servings') }}</div>
                  </div>
               </div>

               <!-- Prep Time -->
               <div class="col-xs-6 col-md-3 col-lg-2">
                  <div class="form-group">
                     {{ Form::label("prep_time", "Prep Time", ['class'=>'required']) }}
                     {{ Form::number ('prep_time', null, array('class' => 'form-control form-control-sm', 'placeholder'=>'minutes')) }}
                     <div class="pl-1 bg-danger">{{ $errors->first('prep_time') }}</div>
                  </div>
               </div>

               <!-- Cook Time -->
               <div class="col-xs-6 col-md-3 col-lg-2">
                  <div class="form-group">
                     {{ Form::label("cook_time", "Cook Time", ['class'=>'required']) }}
                     {{ Form::number ('cook_time', null, array('class' => 'form-control form-control-sm', 'placeholder'=>'minutes')) }}
                     <div class="pl-1 bg-danger">{{ $errors->first('cook_time') }}</div>
                  </div>
               </div>

               <!-- Make Private -->
               <div class="col-xs-6 col-md-3 col-lg-2">
                  <div class="form-group">
                     {!! Form::label("personal", "Make Private") !!}
                     {{ Form::select('personal', array('0' => 'No', '1' => 'Yes'), 0, ['class'=>'form-control form-control-sm']) }}
                  </div>
               </div>

               <!-- Public Notes -->
               <div class="col-xs-12 col-md-6">
                  <div class="form-group">
                     {!! Form::label("public_notes", "Public Notes") !!}
                     {{ Form::textarea ('public_notes', null, array('class' => 'form-control form-control-sm simple', 'rows'=>'2')) }}
                  </div>
               </div>

               <!-- Author's Notes -->
               <div class="col-xs-12 col-md-6">
                  <div class="form-group">
                     {!! Form::label("private_notes", "Author's Personal Notes") !!} <small>(not shown to public)</small>
                     {{ Form::textarea ('private_notes', null, array('class' => 'form-control form-control-sm simple', 'rows'=>'2')) }}
                  </div>
               </div>

               <!-- Source -->
               <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                     {!! Form::label("source", "Source") !!}
                     {{ Form::text ('source', null, array('class' => 'form-control form-control-sm')) }}
                  </div>
               </div>

               <!-- Image -->
               <div class="col-xs-6 col-sm-3">
                  <div class="form-group">
                     {!! Form::label("image", "Image") !!}
                     {{ Form::file('image', ['class'=>'form-control form-control-sm p-0']) }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   {!! Form::close() !!}

@endsection

@section('scripts')
@endsection
