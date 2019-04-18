@extends('layouts.backend')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.adminNav')
   @include('categories.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="card">
      <div class="card-header bg-danger text-white text-center"><b>ARE YOU SURE YOU WANT TO DELETE THIS CATEGORY?</b></div>
      <div class="card-body card_body text-center">
         <form
            action="{{ route('categories.destroy', [$category->id]) }}"
            method="POST"
            {{-- onsubmit="return confirm('Do you really want to delete this permission?');" class="pull-right" --}}
            >

            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE" />

            <a class="btn btn-outline-secondary" href="{{ route('categories.index') }}">No - Return To Previous Page</a>
            
            @if(checkPerm('permission_delete'))
               <button type="submit" class="btn btn-outline-danger">
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