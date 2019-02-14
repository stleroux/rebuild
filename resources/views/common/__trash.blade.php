@extends('layouts.master')

@section('left_column')
   @include('blocks.admin_menu')
@endsection

@section('right_column')
@endsection

@section('content')
{{ $model }}
   <div class="card">
      <div class="card-header bg-danger text-white text-center"><b>ARE YOU SURE YOU WANT TO TRASH THIS {{ strtoupper($model) }}?</b></div>
      <div class="card-body card_body text-center">
         <form action="{{ route($model.'s.'.'trashDestroy', $id) }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE" />

            {{-- <a href="{{ route($model.'s.'. Session::get('pageName'), $model->id) }}" class="btn btn-outline-secondary"> --}}
               <i class="fas fa-angle-double-left"></i>
                No - Return To Previous Page
            </a>
            
            @if(checkPerm('post_delete'))
               <button type="submit" class="btn btn-outline-danger">
                  <i class="far fa-trash-alt"></i>
                  Yes - Trash This {{ ucfirst($model) }}
               </button>
            @endif
            
         </form>
      </div>
      {{-- <div class="card-footer pt-1 pb-1 pl-2">
         <b>Note: </b>This record will not be recoverable if deleted.
      </div> --}}
   </div>

@endsection