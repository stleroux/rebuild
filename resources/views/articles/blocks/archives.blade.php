<div class="card mb-3 p-0 m-0">
   <div class="card-header block_header p-2 m-0">
      <i class="fa fa-file-text-o" aria-hidden="true"></i>
      Article Archives
   </div>
   <div class="card-body card_body p-0">
      @if(count($articlelinks) > 0)
         <ul class="list-group">
            @foreach($articlelinks as $alink)
               <a href="{{ route('articles.archive', ['year'=>$alink->year, 'month'=>$alink->month]) }}"
                  class="list-group-item list-group-item-action p-1">
                  {{ $alink->month_name }} - {{ $alink->year }}
                  <span class="badge badge-secondary float-right">
                     {{ $alink->article_count }}
                  </span>
               </a>
            @endforeach
         </ul>
      @else
         <div class="text text-center">No Data Available</div>
      @endif
   </div>
</div>