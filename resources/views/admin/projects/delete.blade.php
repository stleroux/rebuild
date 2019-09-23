@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   {{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
   @include('projects.blocks.popularProjects')
@endsection

@section('content')

   <div class="card">
      <div class="card-header section_header text-center p-2">
         <b class="text-danger">
            ARE YOU SURE YOU WANT TO PERMANENTLY DELETE THIS PROJECT?<br />
            {{-- Title : {{ $woodproject->title }}? --}}
         </b>
      </div>
      <div class="card-body bg-light text-center">
         {!! Form::open(['method'=>'POST', 'route'=>['admin.projects.destroy', $project->id]]) !!}
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE" />

            <a href="{{ URL::previous() }}" class="btn btn-secondary">
               <i class="fas fa-angle-double-left"></i>
                No - Return To Previous Page
            </a>
            
            {{-- @if(checkPerm('post_delete')) --}}
               <button type="submit" class="btn btn-danger">
                  <i class="far fa-trash-alt"></i>
                  Yes - Permanently Delete This Recipe
               </button>
            {{-- @endif --}}
         {{ Form::close() }}
      </div>
      <div class="card-footer pt-1 pb-1 pl-2">
         <b>Note: </b>This record will not be recoverable if deleted.
      </div>
   </div>

@endsection