<div class="row p-0 pb-2">
   <div class="col-sm-6 pr-1">
      <div class="card text-light">
         <div class="card-header card_header p-1">Material(s) Used In This Project</div>
         @if($project->materials->count() > 0)
            <table class="table table-sm table-hover table-striped mb-0 text-light">
               <thead>
                  <tr>
                     <th>Name</th>
                     <th>Type</th>
                     <th>Manufacturer</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($project->materials as $m)
                     <tr>
                        <td>{{ $m->name }}</td>
                        <td>{{ $m->type ?? "N/A" }}</td>
                        <td>{{ $m->manufacturer ?? "N/A" }}</td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         @else
            <div class="pl-1">N/A</div>
         @endif
      </div>
   </div>
</div>
