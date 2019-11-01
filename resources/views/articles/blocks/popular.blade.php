<div class="card mb-2">
   <div class="card-header block_header p-2">
      <i class="fab fa-apple"></i>
      Popular Articles
   </div>
   <div class="card-body p-0 m-0">
      @if($popular->count() > 0)
         <ul class="list-group px-0 py-0">
            @foreach ($popular as $p)
               <a class="list-group-item list-group-item-action p-1" href="{{ route('articles.show', $p->id) }}" role="button" style="text-decoration: none">
                  <div class="text text-left">
                     <i class="far fa-address-card fa-fw"></i>
                     {{ $p->title }}
                     <span class="badge badge-info text-dark float-right">{{ $p->views }}</span>
                  </div>
               </a>
            @endforeach
         </ul>
      @else
         <div class="p-1">
            {{ setting('no_records_found') }}
         </div>
      @endif
   </div>
</div>
