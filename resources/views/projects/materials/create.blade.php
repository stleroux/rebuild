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
         <div class="card-header section_header p-2">
            <i class="fa fa-plus-square"></i>
            Create Material
            <span class="float-right">
               @include('projects.materials.addins.links.help', ['size'=>'xs', 'bookmark'=>'materials'])
               @include('projects.materials.addins.links.back', ['size'=>'xs'])
               @include('projects.materials.addins.buttons.save', ['size'=>'xs'])
            </span>
         </div>

         <!-- CARD BODY -->
         <div class="card-body section_body p-2">
            @include('projects.materials.form')            
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer p-1">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
