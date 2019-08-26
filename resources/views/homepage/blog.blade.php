{{-- BLOG --}}
@if($posts->count() > 0)
   <div class="card mb-3">
      <div class="card-header section_header p-2">
         <i class="far fa-newspaper"></i>
         Latest Posts
      </div>
      <div class="card-body section_body p-2">
         @if(count($posts) > 0)
            @foreach ($posts as $post)
               <div class="card mb-2">
                  <div class="card_header p-2">{{ $post->title }}</div>
                  <div class="card_body p-2">
                     <div class="row">
                     <div class="col-sm-10">
                        <p>{{ substr(strip_tags($post->body), 0, 250) }} {{ strlen(strip_tags($post->body)) > 250 ? " [More]..." : "" }}</p>
                     </div>
                     <div class="col-sm-2">
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-xs btn-primary float-right">
                        <div class="text text-left">
                           <i class="fa fa-chevron-right"></i> More
                        </div>
                        </a>
                     </div>
                     </div>
                  </div>
                  <div class="card-footer card_footer pl-2 p-1">
                     Created by
                     @include('common.authorFormat', ['model'=>$post, 'field'=>'user'])
                     on @include('common.dateFormat', ['model'=>$post, 'field'=>'created_at'])
                  </div>
               </div>
            @endforeach
         @else
            No Records Found
         @endif
      </div>
   </div>
@endif
