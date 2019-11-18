@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')
   
   {!! Form::open(['route'=>'admin.projects.materials.store', 'files'=>'true']) !!}
   
      <div class="card mb-3">
         
         <!-- CARD HEADER -->
         <div class="card-header section_header p-2">
            <i class="fa fa-plus-square"></i>
            Create Material
            <span class="float-right">
               <div class="btn-group">
                  @include('admin.projects.materials.buttons.help', ['size'=>'xs', 'bookmark'=>'materials'])
                  @include('admin.projects.materials.buttons.back', ['size'=>'xs'])
                  @include('admin.projects.materials.buttons.save', ['size'=>'xs'])
               </div>
            </span>
         </div>

         <!-- CARD BODY -->
         <div class="card-body section_body p-2">
            @include('admin.projects.materials.form')            
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer p-1">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
