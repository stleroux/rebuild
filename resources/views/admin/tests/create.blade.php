@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.tests.blocks.sidebar')
   @include('admin.tests.blocks.archives')
@endsection

@section('content')
   
   {!! Form::open(['route' => 'admin.tests.store', 'files'=>'true']) !!}
   
      <div class="card mb-3">

         <div class="card-header section_header p-2">
            <i class="fa fa-plus-square"></i>
            Create Test
            <div class="float-right">
               <div class="btn-group">
                  @include('admin.tests.buttons.help', ['size'=>'xs', 'model'=>'test', 'bookmark'=>'tests'])
                  @include('admin.tests.buttons.back', ['size'=>'xs', 'model'=>'test'])
                  @include('admin.tests.buttons.save', ['size'=>'xs', 'model'=>'test'])
               </div>
            </div>
         </div>

         <div class="card-body section_body p-2">
            @include('admin.tests.form')            
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
