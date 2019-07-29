@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')
   
   {!! Form::open(['route' => 'materials.store', 'files'=>'true']) !!}
   
      <div class="card mb-3">
         
         <!-- CARD HEADER -->
         <div class="card-header section_header p-1 m-0">
            <span class="h5 align-middle pt-2">
               <i class="fa fa-plus-square"></i>
               Create Material
            </span>
            <span class="float-right">
               @include('projects.materials.addins.links.help', ['model'=>'material', 'bookmark'=>'materials'])
               @include('projects.materials.addins.links.back', ['model'=>'material'])
               @include('projects.materials.addins.buttons.save', ['model'=>'material'])
            </span>
         </div>

         <!-- CARD BODY -->
         <div class="card-body pb-1">
            @include('projects.materials.form')            
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
