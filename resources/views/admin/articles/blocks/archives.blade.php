<div class="card mb-3 p-0 m-0">
   <div class="card-header block_header p-2 m-0">
      <i class="fa fa-file-text-o" aria-hidden="true"></i>
      Article Archives
   </div>
   <div class="card-body card_body p-0">
      @if(count($links) > 0)
         <ul class="list-group">
            @foreach($links as $link)
               <a href="{{ route('admin.articles.archive', ['year'=>$link->year, 'month'=>$link->month]) }}"
                  class="list-group-item list-group-item-action p-1">
                  {{ $link->month_name }} - {{ $link->year }}
                  <span class="badge badge-secondary float-right">
                     {{ $link->article_count }}
                  </span>
               </a>
            @endforeach
         </ul>
      @else
         <div class="text text-center">No Data Available</div>
      @endif
   </div>
</div>