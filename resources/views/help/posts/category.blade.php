<div class="card mb-2" id="posts_add_post">
      <div class="card-header bg-primary">
      <span class="h4">Add A Post</span>
      <span class="float-right">
         <a href="#" class="btn btn-xs btn-secondary"><small>Top</small></a>
         <a href="#posts" class="btn btn-xs btn-secondary"><small>Section Top</small></a>
      </span>
   </div>
   <div class="card-body p-2">
      {{-- <div class="row"> --}}
         {{-- <div class="col"> --}}
            <p>Text about the posts section</p>
            <p><h5>Required field(s)</h5></p>
            <table class="table table-bordered table-sm table-hover">
               <thead class="thead-dark">
                  <tr>
                     <th style="width: 20%">Field</th>
                     <th>Description</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Main Post</td>
                     <td>This will create a top level Post in the system that will be used to sort the sub-posts</td>
                  </tr>
                  <tr>
                     <td>Sub Post</td>
                     <td>This will create a sub level Post in the system that will appear under the main post selected</td>
                  </tr>
                  <tr>
                     <td>Post</td>
                     <td>This will create a Post in the system that will appear under the sub post selected</td>
                  </tr>
               </tbody>
            </table>
         {{-- </div> --}}
      {{-- </div> --}}
      {{-- <div class="row"> --}}
         {{-- <div class="col"> --}}
            <p><h5>Optional field(s)</h5></p>
            <table class="table table-bordered table-sm table-hover">
               <thead class="thead-dark">
                  <tr>
                     <th style="width: 20%">Field</th>
                     <th>Description</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Value</td>
                     <td>The Value field is only required if you want to create a new Landing Page entry. This is because the Landing Pages display a different value (which is more meaningful to the user) then the one stored in the system.</td>
                  </tr>
                  <tr>
                     <td>Description</td>
                     <td>Fill out a description of the field.</td>
                  </tr>
               </tbody>
            </table>
         {{-- </div> --}}
      {{-- </div> --}}
   </div>
</div>
