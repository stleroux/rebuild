@extends ('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/recipes.css') }}
   {{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> --}}
@stop

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('recipes.blocks.popularRecipes')
   @include('recipes.blocks.archives')
@endsection

@section ('content')
   {!! Form::model($recipe, ['route'=>['recipes.update', $recipe->id], 'method' => 'PUT', 'files' => true]) !!}
      <div class="card mb-3">
         <div class="card-header section_header p-2">
            <i class="fa fa-edit"></i>
            Edit Recipe
            <span class="float-right">
               @include('recipes.addins.links.help', ['size'=>'xs', 'bookmark'=>'recipes'])
               @include('recipes.addins.links.back', ['size'=>'xs'])
               @include('recipes.addins.buttons.update', ['size'=>'xs'])
            </span>
         </div>

         <div class="card-body section_body p-2">
            <div class="row">
               <!-- Title -->
               <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                     {!! Form::label("title", "Title", ['class'=>'required']) !!}
                     {!! Form::text("title", null, ["class" => "form-control form-control-sm", "autofocus", 'onfocus' => 'this.focus();this.select()']) !!}
                     <span class="text-danger">{{ $errors->first('title') }}</span>
                  </div>
               </div>

               <!-- Category -->
               <div class="col-xs-12 col-sm-6 col-md-3">
                  <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}" >
                     {!! Form::label("category_id", "Category", ['class'=>'required']) !!}
                     <select name="category_id" id="catSelect" class="form-control form-control-sm">
                        {{-- <option value="{{ $recipe->category->name }}">{{ $recipe->category->name }}</option> --}}
                        @foreach ($categories as $category)
                           <option disabled>{{ ucfirst($category->name) }}</option>
                           @foreach ($category->children as $children)
                              <option value="{{ $children->id }}" {{ ($recipe->category_id == $children->id ) ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ ucfirst($children->name) }}</option>
                           @endforeach
                        @endforeach
                     </select>
                  </div>
               </div>

               <!-- Publish Date -->
               @if(checkperm('recipe_publish'))
                  <div class="col-xs-12 col-sm-6 col-md-3">
                     <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
                        {{ Form::label('published_at', 'Publish(ed) On' ) }}
                        <div class="input-group input-group-sm">
                           {{ Form::text('published_at', null, ['class'=>'form-control form-control-sm', 'id'=>'datePicker']) }}
                           <div class="input-group-append">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                           </div>
                        </div>
                        <span class="text-danger">{{ $errors->first('published_at') }}</span>
                     </div>
                  </div>
               @endif

               <!-- Ingredients -->
               <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group {{ $errors->has('ingredients') ? 'has-error' : '' }}">
                     {{ Form::label('ingredients', 'Ingredients', ['class'=>'required']) }} <small>(One per line)</small>
                     {{ Form::textarea('ingredients', null, ['class'=>'form-control form-control-sm simple', 'rows'=>'8']) }}
                     <span class="text-danger">{{ $errors->first('ingredients') }}</span>
                  </div>
               </div>
               
               <!-- Methodology -->
               <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group {{ $errors->has('methodology') ? 'has-error' : '' }}">
                     {{ Form::label('methodology', 'Methodology', ['class'=>'required']) }} <small>(One per line)</small>
                     {{ Form::textarea('methodology', null, ['class'=>'form-control form-control-sm simple', 'rows'=>'8']) }}
                     <span class="text-danger">{{ $errors->first('methodology') }}</span>
                  </div>
               </div>

               <!-- Servings -->
               <div class="col-xs-6 col-md-3 col-lg-2">
                  <div class="form-group {{ $errors->has('servings') ? 'has-error' : '' }}" >
                     {!! Form::label("servings", "Servings") !!}
                     {{ Form::number ('servings', null, array('class' => 'form-control form-control-sm')) }}
                     <span class="text-danger">{{ $errors->first('servings') }}</span>
                  </div>
               </div>

               <!-- Prep Time -->
               <div class="col-xs-6 col-md-3 col-lg-2">
                  <div class="form-group {{ $errors->has('prep_time') ? 'has-error' : '' }}" >
                     {!! Form::label("prep_time", "Prep Time") !!}
                     {{ Form::number ('prep_time', null, array('class' => 'form-control form-control-sm', 'placeholder'=>'minutes')) }}
                     <span class="text-danger">{{ $errors->first('prep_time') }}</span>
                  </div>
               </div>

               <!-- Cook Time -->
               <div class="col-xs-6 col-md-3 col-lg-2">
                  <div class="form-group {{ $errors->has('cook_time') ? 'has-error' : '' }}" >
                     {!! Form::label("cook_time", "Cook Time") !!}
                     {{ Form::number ('cook_time', null, array('class' => 'form-control form-control-sm', 'placeholder'=>'minutes')) }}
                     <span class="text-danger">{{ $errors->first('cook_time') }}</span>
                  </div>
               </div>

               <!-- Make Private -->
               <div class="col-xs-6 col-md-3 col-lg-2">
                  <div class="form-group {{ $errors->has('private') ? 'has-error' : '' }}" >
                     {!! Form::label("personal", "Make Private") !!}
                     {{ Form::select('personal', array('0' => 'No', '1' => 'Yes'), $recipe->personal, ['class'=>'form-control form-control-sm']) }}
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
                     {!! Form::text("source", null, ["class" => "form-control form-control-sm"]) !!}
                     <span class="text-danger">{{ $errors->first('source') }}</span>
                  </div>
               </div>

               <!-- Image -->
               <div class="col-xs-6 col-sm-2">
                  <table width="100%">
                     <tr>
                        <th>Current Image</th>
                     </tr>
                     <tr>
                        <td>
                           @if ($recipe->image)
                              {{ Html::image("_recipes/" . $recipe->image, "", array('height'=>'125','width'=>'125')) }}
                           @else
                              <i class="fa fa-5x fa-ban" aria-hidden="true"></i>
                           @endif
                        </td>
                     </tr>
                  </table>
               </div>

               <div class="col-xs-6 col-sm-4">
                  {!! Form::label("image", "Replace Image") !!}
                  {{ Form::file('image', ['class'=>'form-control form-control-sm p-0']) }}
                  <span class="help-block">Only choose new image to replace the existing one.</span>
               </div>

            </div>
         </div>
      </div>
   {!! Form::close() !!}
@stop
