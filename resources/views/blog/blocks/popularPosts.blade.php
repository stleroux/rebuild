@if($popularPosts->count() > 0)
   <div class="card mb-2">
      <div class="card-header block_header p-2">
         <i class="fas fa-blog"></i>
         Popular Blog Posts
      </div>
      <div class="card-body p-0">
         <ul class="list-group px-0 py-0">
            @foreach ($popularPosts as $b)
               <a class="list-group-item list-group-item-action p-1" href="{{ route('blog.show', $b->slug) }}" role="button" style="text-decoration: none">
                  <div class="text text-left">
                     <i class="far fa-address-card"></i>
                     {{ $b->title }}
                     <span class="badge badge-danger float-right">{{ $b->views }}</span>
                  </div>
               </a>
            @endforeach
         </ul>
      </div>
   </div>
@endif
