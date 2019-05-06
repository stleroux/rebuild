{{-- @if(\Module::enabled('Posts')) --}}
   @if($popularPosts->count() > 0)
      <div class="card mb-2">
         <div class="card-header">POPULAR BLOG</div>
         <div class="card-body p-0 m-0">
            @foreach ($popularPosts as $b)
               <a class="list-group-item p-1 m-0" href="{{ route('blog.single', $b->slug) }}" role="button">
                  <div class="text text-left">
                     <i class="far fa-address-card"></i>
                     {{ $b->title }}
                     <span class="badge badge-danger float-right">{{ $b->views }}</span>
                  </div>
               </a>
            @endforeach
         </div>
      </div>
   @endif
{{-- @endif --}}