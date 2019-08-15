@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="card">
      <div class="card-header section_header text-center p-2">
         <b class="text-danger">
            ARE YOU SURE YOU WANT TO PERMANENTLY DELETE THIS PERMISSION?<br />
         </b>
      </div>
      <div class="card-body bg-light p-2 text-center">
         <form
            action="{{ route('permissions.destroy', [$permission->id]) }}"
            method="POST"
            {{-- onsubmit="return confirm('Do you really want to delete this permission?');" class="pull-right" --}}
            >

            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE" />

            <a class="btn btn-secondary" href="{{ route('permissions.index') }}">No - Return To Previous Page</a>
            
            @if(checkPerm('permission_delete'))
               <button type="submit" class="btn btn-danger">
                  <i class="far fa-trash-alt" aria-hidden="true"></i>
                  Yes - Delete Permanently
               </button>
            @endif
         </form>
      </div>
      <div class="card-footer pt-1 pb-1 pl-2">
         <b>Note: </b>This record will not be recoverable if deleted.
      </div>
   </div>

@endsection
