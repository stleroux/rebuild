@extends('layouts.master')

@section('left_column')
   @include('blocks.adminNav')
   @include('recipes::backend.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="card">
      <div class="card-header bg-danger text-white text-center"><b>ARE YOU SURE YOU WANT TO TRASH THIS RECIPE?</b></div>
      <div class="card-body card_body text-center">
         <form action="{{ route('recipes.trashDestroy', $recipe->id) }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE" />

            <a href="{{-- {{ route('recipes.'. Session::get('pageName'), $recipe->id) }} --}}{{ URL::previous() }}" class="btn btn-outline-secondary">
               <i class="fas fa-angle-double-left"></i>
                No - Return To Previous Page
            </a>
            
            @if(checkPerm('post_delete'))
               <button type="submit" class="btn btn-outline-danger">
                  <i class="far fa-trash-alt"></i>
                  Yes - Trash This Recipe
               </button>
            @endif
            
         </form>
      </div>
      <div class="card-footer pt-1 pb-1 pl-2">
         This will also remove all favorites that poeple have vreated for this recipe.
      </div>
   </div>

@endsection