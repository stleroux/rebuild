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
   
   <div class="card mb-3">

      <div class="card-header">
         <i class="fa fa-plus-square"></i>
         Show Woodproject
         <span class="float-right">
            @include('woodprojects.addins.links.help', ['model'=>'woodproject', 'bookmark'=>'woodprojects'])
            @include('woodprojects.addins.links.back', ['model'=>'category'])
         </span>
      </div>

      <div class="card-body">
         <p>{{ $woodproject->name }}</p>
      </div>

   </div>
   
@endsection
