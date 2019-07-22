<div class="row p-0 pb-1">
   <div class="col-sm-2 pr-1">
      <div class="card text-light">
         <div class="card-header card_header p-1">Width <small>(inches)</small></div>
         <div class="card-body p-1">{{ $project->width ?? "N/A" }}</div>
      </div>
   </div>
   <div class="col-sm-2 px-1">
      <div class="card text-light">
         <div class="card-header card_header p-1">Depth <small>(inches)</small></div>
         <div class="card-body p-1">{{ $project->depth ?? "N/A" }}</div>
      </div>
   </div>
   <div class="col-sm-2 px-1">
      <div class="card text-light">
         <div class="card-header card_header p-1">Height <small>(inches)</small></div>
         <div class="card-body p-1">{{ $project->height ?? "N/A" }}</div>
      </div>
   </div>
   <div class="col-sm-2 px-1">
      <div class="card text-light">
         <div class="card-header card_header p-1">Weight <small>(pounds)</small></div>
         <div class="card-body p-1">{{ $project->weight ?? "N/A" }}</div>
      </div>
   </div>
   <div class="col-sm-2 pl-1">
      <div class="card text-light">
         <div class="card-header card_header p-1">Completion Date</div>
         <div class="card-body p-1">{{ ($project->completed_at ? $project->completed_at->format('M d, Y') : "In Progress") }}</div>
      </div>
   </div>
</div>

