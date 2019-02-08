@extends('layouts.master')

@section('content')


   <div class="card mb-2">
      <div class="card-header card_header">
         <i class="far fa-newspaper" aria-hidden="true"></i>
         Latest Posts
      </div>

      @if(count($posts) > 0)
         <div class="card-body card_body">
            @foreach ($posts as $post)
               <div class="card mb-2 bg-transparent">
                  <div class="card-header card_header_2">{{ $post->title }}</div>
                  <div class="card-body card_body">
                     <div class="row">
                     <div class="col-sm-10">
                        <p>{{ substr(strip_tags($post->body), 0, 250) }} {{ strlen(strip_tags($post->body)) > 250 ? " [More]..." : "" }}</p>
                     </div>
                     <div class="col-sm-2">
                        <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-sm btn-primary">
                           <div class="text text-left">
                              <i class="fa fa-chevron-right" aria-hidden="true"></i> Read More
                           </div>
                        </a>
                     </div>
                     </div>
                  </div>
                  <div class="card-footer bg-transparent px-1 py-1">
                     Created by {{ $post->user->username }}
                     {{-- @include('common.authorFormat', ['model'=>$post, 'field'=>'user']) --}}
                     on {{-- @include('common.dateFormat', ['model'=>$post, 'field'=>'created_at']) --}}
                     {{ $post->created_at->format('M d, Y') }}
                  </div>
               </div>
            @endforeach
         </div>
         <div class="card-footer pb-0 mb-0 py-2 px-2">
            {{-- {!! $posts->links() !!} --}}
            {{-- {{ $posts->links('vendor.pagination.bootstrap-4') }} --}}
            {{ $posts->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}
         </div>
      @else
         {{-- @include('common.noRecordsFound', ['name'=>'Latest Posts', 'icon'=>'newspaper-o', 'color'=>'primary']) --}}
         <div class="card-body card_body">
            No records found in the system
         </div>
      @endif
   </div>


@endsection