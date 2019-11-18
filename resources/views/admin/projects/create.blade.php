@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')
   
   {!! Form::open(['route' => 'admin.projects.store', 'files'=>'true']) !!}

      <div class="card mb-3">

         <div class="card-header section_header p-1 m-0">
            <span class="h5 align-middle pt-2">
               <i class="fa fa-plus-square"></i>
               Create Project
            </span>
            <span class="float-right">
               <div class="btn-group">
                  @include('admin.projects.buttons.help', ['size'=>'xs', 'bookmark'=>'projects'])
                  @include('admin.projects.buttons.back', ['size'=>'xs'])
                  @include('admin.projects.buttons.save', ['size'=>'xs'])
               </div>
            </span>
         </div>

         <div class="card-body section_body">

            <div class="form-row pt-2">
               <div class="col-xs-12 col-sm-4">
                  <div class="form-group">
                     {!! Form::label('name', 'Project Name', ['class'=>'required']) !!}
                     {!! Form::text('name', null, ['class' => 'form-control form-control-sm', 'autofocus', 'onfocus' => 'this.focus();this.select()']) !!}
                     <div class="pl-1 bg-danger">{{ $errors->first('name') }}</div>
                  </div>
               </div>
               <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                  <div class="form-group">
                     {{ Form::label('category', 'Category', ['class'=>'required']) }}
                     <select name="category" value="{{ old('category') ?? $project->category }}" id="category" class="form-control form-control-sm">
                        @foreach($project->categoriesOptions() as $categoryOptionKey => $categoryOptionValue)
                           <option value="{{ $categoryOptionKey }}" {{ $project->category == $categoryOptionValue ? 'selected' : '' }}>{{ $categoryOptionValue }}</option>
                        @endforeach
                     </select>
                     <div class="pl-1 bg-danger">{{ $errors->first('category') }}</div>
                  </div>
               </div>
            </div>

            <div class="form-row">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="form-group">
                     {!! Form::label('description', 'Project Description', ['class'=>'required']) !!}
                     {!! Form::textarea('description', null, ['class' => 'form-control form-control-sm', 'rows'=>3]) !!}
                     <div class="pl-1 bg-danger">{{ $errors->first('description') }}</div>
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
