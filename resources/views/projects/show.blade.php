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
         Show Project
         <span class="float-right">
            @include('projects.addins.links.help', ['model'=>'project', 'bookmark'=>'projects'])
            @include('projects.addins.links.back', ['model'=>'project'])
         </span>
      </div>

      <div class="card-body">
         <p>{{ $project->name }}</p>
      </div>

   </div>
   
@endsection
