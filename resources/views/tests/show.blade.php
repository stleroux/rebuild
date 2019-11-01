@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')
   
   <div class="card mb-3">

      <div class="card-header">
         <i class="fa fa-plus-square"></i>
         Show Test
         <span class="float-right">
            @include('tests.addins.links.help', ['model'=>'test', 'bookmark'=>'tests'])
            @include('tests.addins.links.back', ['model'=>'category'])
         </span>
      </div>

      <div class="card-body">
         <p>{{ $test->name }}</p>
      </div>

   </div>
   
@endsection
