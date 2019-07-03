@extends('layouts.backend')

@section('stylesheets')
   {{-- {{ Html::style('css/.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')
   
   {!! Form::open(['route' => 'projects.store', 'files'=>'true']) !!}
      @csrf

      <div class="card mb-3">

         <div class="card-header">
            <i class="fa fa-plus-square"></i>
            Create Project
            <span class="float-right">
               @include('projects.addins.links.help', ['model'=>'project', 'bookmark'=>'projects'])
               @include('projects.addins.links.back', ['model'=>'project'])
               @include('projects.addins.buttons.save', ['model'=>'project'])
            </span>
         </div>

         <div class="card-body p-2">

            <div class="form-row pt-2">
               <div class="col-xs-12 col-sm-4">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {!! Form::label('name', 'Project Name', ['class'=>'required']) !!}
                     {!! Form::text('name', null, ['class' => 'form-control form-control-sm', 'autofocus', 'onfocus' => 'this.focus();this.select()']) !!}
                     <span class="text-danger">{{ $errors->first('name') }}</span>
                  </div>
               </div>
               <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                  <div class="form-group">
                     <label for="category">Category</label>
                     <select name="category" value="{{ old('category') ?? $project->category }}" id="category" class="form-control form-control-sm">
                        @foreach($project->categoriesOptions() as $categoryOptionKey => $categoryOptionValue)
                           <option value="{{ $categoryOptionKey }}" {{ $project->category == $categoryOptionValue ? 'selected' : '' }}>{{ $categoryOptionValue }}</option>
                        @endforeach
                     </select>
                     <div class="text-danger">{{ $errors->first('category') }}</div>
                  </div>
               </div>
            </div>

            <div class="form-row">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                     {!! Form::label('description', 'Project Description', ['class'=>'required']) !!}
                     {!! Form::textarea('description', null, ['class' => 'form-control form-control-sm', 'rows'=>3]) !!}
                     <span class="text-danger">{{ $errors->first('description') }}</span>
                  </div>
               </div>
            </div>
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection

@section('scripts')
   <script>
      // Add the following code if you want the name of the file appear on select
      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
   </script>
@endsection
