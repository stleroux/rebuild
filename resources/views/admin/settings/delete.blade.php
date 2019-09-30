@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.adminNav')
   @include('settings.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::open(['route'=>['admin.settings.destroy', $setting->id], 'method'=>'DELETE']) !!}

      <div class="card">
         <div class="card-header bg-danger text-white text-center"><b>ARE YOU SURE YOU WANT TO DELETE THIS SETTING?</b></div>
         <div class="card-body card_body text-center">
            <input type="hidden" name="_method" value="DELETE" />

            <a class="btn btn-outline-secondary" href="{{ route('settings.index') }}">No - Return To Previous Page</a>
            
            @if(checkPerm('permission_delete'))
               <button type="submit" class="btn btn-outline-danger">
                  <i class="far fa-trash-alt" aria-hidden="true"></i>
                  Yes - Delete Permanently
               </button>
            @endif

         </div>
         <div class="card-footer pt-1 pb-1 pl-2 text-danger">
            <b>Note: </b>This record will not be recoverable if deleted.
         </div>
      </div>

   {{ Form:: close() }}

@endsection