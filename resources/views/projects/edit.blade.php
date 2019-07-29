@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section ('content')

      <div class="form-row">
         <div class="col-12">
            <!-- MAIN CARD -->
            <div class="card">
               <!-- MAIN CARD HEADER -->
               <div class="card-header section_header p-1 m-0">
                  <span class="h5 align-middle pt-2">
                     <i class="fa fa-edit"></i>
                     Edit Project
                  </span>
                  <span class="float-right">
                     {!! Form::model($project, ['route'=>['projects.update', $project->id], 'method' => 'POST', 'files' => true]) !!}
                     @csrf
                     @method("PUT")
                     @include('projects.addins.links.help', ['size'=>'sm', 'bookmark'=>'projects'])
                     @include('projects.addins.links.back', ['size'=>'sm'])
                     @include('projects.addins.buttons.update', ['size'=>'sm'])
                  </span>
               </div>
               <!-- MAIN CARD BODY -->
               <div class="card-body section_body p-2">
                  
                     <div class="form-row">

                        <div class="col-md-7">
                           @include('projects.partials.general')
                        </div>
                        <div class="col-md-5">
                           @include('projects.partials.others')
                        </div>
                     </div>
                  {!! Form::Close() !!}
                  
                  <div class="form-row">
                     <div class="col-md-4">
                        @include('projects.partials.materials')
                     </div>
                     <div class="col-md-4">
                        @include('projects.partials.finishes')
                     </div>
                     <div class="col-md-4">
                        {{-- <span class="text-danger">{{ $errors->first('image') }}</span> --}}
                        @include('projects.partials.images')
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
   




      {{-- @include('projects.form') --}}
   

@endsection