<!-- Start of Row is in Materials file -->
   <div class="col-sm-6 pl-1">
      <div class="card text-light">
         <div class="card-header card_header p-1">Finish(es) Used In This Project</div>
         {{-- <div class="card-body p-1"> --}}
            @if($project->finishes->count() > 0)
               <table class="table table-sm table-hover table-striped mb-0 text-light">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Color</th>
                        <th>Manufacturer</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($project->finishes as $f)
                        <tr>
                           <td>{{ $f->name }}</td>
                           <td>{{ $f->type }}</td>
                           <td>{{ $f->color_name }}</td>
                           <td>{{ $f->manufacturer }}</td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            @else
               <div class="pl-1">N/A</div>
            @endif
         {{-- </div> --}}
      </div>
   </div>
</div>
