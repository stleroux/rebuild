@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section ('content')

   {!! Form::model($project, ['route'=>['admin.projects.update', $project->id], 'method'=>'PUT', 'files'=>'true']) !!}

      <div class="form-row">
         <div class="col-12">
            <!-- MAIN CARD -->
            <div class="card mb-3">
               <!-- MAIN CARD HEADER -->
               <div class="card-header section_header p-2">
                  <i class="fa fa-edit"></i>
                  Edit {{ $project->name }} Project
                  <span class="float-right">
                     <div class="btn-group">
                        @include('admin.projects.buttons.help', ['size'=>'xs', 'bookmark'=>'projects'])
                        @include('admin.projects.buttons.back', ['size'=>'xs'])
                        @include('admin.projects.buttons.update', ['size'=>'xs'])
                     </div>
                  </span>
               </div>
               <!-- MAIN CARD BODY -->
               <div class="card-body section_body p-2">
                  
                  <div class="form-row">
                     <div class="col-md-6">
                        @include('admin.projects.partials.edit.general')
                     </div>
                     <div class="col-md-6">
                        @include('admin.projects.partials.edit.others')
                     </div>
                  </div>
   {!! Form::Close() !!}
                  
                  <div class="form-row">
                     <div class="col-md-4">
                        @include('admin.projects.partials.edit.materials')
                     </div>
                     <div class="col-md-4">
                        @include('admin.projects.partials.edit.finishes')
                     </div>
                     <div class="col-md-4">
                        {{-- <span class="text-danger">{{ $errors->first('image') }}</span> --}}
                        @include('admin.projects.partials.edit.images')
                     </div>
                  </div>

               </div>
               <!-- MAIN CARD FOOTER -->
               <div class="card-footer pt-1 pb-1 pl-2">
                  Fields marked with an <span class="required"></span> are required
               </div>
            </div>
         </div>
      </div>
   

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
