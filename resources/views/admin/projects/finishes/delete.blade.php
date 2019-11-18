@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::open(['route'=>['admin.projects.finishes.destroy', $finish->id], 'method'=>'DELETE']) !!}

      <div class="card mb-3">
         <div class="card-header section_header text-center text-danger font-weight-bold p-2">
            ARE YOU SURE YOU WANT TO PERMANENTLY DELETE THIS FINISH?
         </div>
         <div class="card-body bg-light p-2 text-center">
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
         </div>
         <div class="card-footer pt-1 pb-1 pl-2">
            <b>Note: </b>This record will not be recoverable if deleted.
         </div>
      </div>
   
   {{ Form::close() }}

@endsection