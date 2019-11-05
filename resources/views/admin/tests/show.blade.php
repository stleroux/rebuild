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
   
   <div class="card mb-3">

      <div class="card-header section_header p-2">
         <i class="fa fa-plus-square"></i>
         Show Test
         <div class="float-right">
            <div class="btn-group">
               @include('admin.tests.buttons.help', ['size'=>'xs', 'model'=>'test', 'bookmark'=>'tests'])
               @include('admin.tests.buttons.back', ['size'=>'xs', 'model'=>'category'])
            </div>
         </div>
      </div>

      <div class="card-body section_body p-2">
         <p>{{ $test->name }}</p>
      </div>

   </div>
   
@endsection
