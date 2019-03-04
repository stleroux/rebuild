@extends('layouts.backend')

@section('left_column')
   @include('blocks.adminNav')
   @include('posts::sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="card">
      <div class="card-header bg-danger text-white text-center"><b>ARE YOU SURE YOU WANT TO DELETE THIS POST?</b></div>
      <div class="card-body card_body text-center">
         <form
            action="{{ route('posts.deleteDestroy', $post->id) }}"
            method="POST">

            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE" />

            {{-- <a class="btn btn-outline-secondary" href="{{ route('posts.index') }}">No - Return To Previous Page</a> --}}
            <a href="{{ route('posts.'. Session::get('pageName')) }}" class="btn btn-outline-secondary">
               <i class="fas fa-angle-double-left"></i>
               No - Return To Previous Page
            </a>

            
            @if(checkPerm('post_delete'))
               <button type="submit" class="btn btn-outline-danger">
                  <i class="far fa-trash-alt"></i>
                  Yes - Permanently Delete This Post
               </button>
            @endif
         </form>
      </div>
      <div class="card-footer pt-1 pb-1 pl-2">
         <b>Note: </b>This record will not be recoverable if deleted.
      </div>
   </div>

@endsection
