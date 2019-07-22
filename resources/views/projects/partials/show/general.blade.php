<div class="row p-0 pb-1">
   <div class="col-sm-3 pr-1">
      <div class="card text-light">
         <div class="card-header card_header p-1">Category</div>
         <div class="card-body p-1">{{ $project->category }}</div>
      </div>
   </div>
   <div class="col-sm-3 px-1">
      <div class="card text-light">
         <div class="card-header card_header p-1">Shop Time</div>
         <div class="card-body p-1">
            @if($project->time_invested)
               {{ $project->time_invested }} Hours
            @else
               N/A
            @endif
         </div>
      </div>
   </div>
   <div class="col-sm-3 px-1">
      <div class="card text-light">
         <div class="card-header card_header p-1">Price</div>
         <div class="card-body p-1">{{ $project->price ? '$ ' . $project->price . '.00' : 'N/A' }}</div>
      </div>
   </div>
   <div class="col-sm-3 pl-1">
      <div class="card text-light">
         <div class="card-header card_header p-1">Views</div>
         <div class="card-body p-1">{{ $project->views ?? "N/A" }}</div>
      </div>
   </div>
</div>

<div class="row p-0 pb-1">
   <div class="col-sm-12">
      <div class="card text-light">
         <div class="card-header card_header p-1">Description</div>
         <div class="card-body p-1">{{ $project->description }}</div>
      </div>
   </div>
</div>