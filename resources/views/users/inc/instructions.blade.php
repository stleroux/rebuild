{{-- <style type="text/css">
   /* https://www.codeply.com/go/OAEz9LcQ0T/bootstrap-fixed-table-header */
   .table-fixed tbody {
      display:block;
      height:450px;
      overflow:auto;
   }
   .table-fixed thead, tbody tr {
      display:table;
      width:100%;
      table-layout:fixed;
   }
   .table-fixed thead {
      width: calc( 100% - 1em )
   }
</style> --}}

<div class="card mb-2">
   
   <div class="card-body card_body p-0">

      <table class="table table-sm table-hover table-bordered table-fixed">
         <thead class="sticky-top">
            <tr class="d-flex">
               <td class="col-7"></td>
               <th class="col-5 text-center">Covered By Permission</th>
            </tr>
            <tr class="d-flex">
               <th class="col-2">Permission Name</th>
               <th class="col-5">Description <span class="text-muted">(Allow user to)</span></th>
               <th class="col-1 text-center">Browse</th>
               <th class="col-1 text-center">Read</th>
               <th class="col-1 text-center">Edit</th>
               <th class="col-1 text-center">Add</th>
               <th class="col-1 mr-5 text-center">Delete</th>
            </tr>
         </thead>

         <tbody>
           <tr class="d-flex">
               <td class="col-2">Browse</td>
               <td class="col-5">BROWSE ALL records</td>
               <td class="col-1 text-center text-success"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>

            <tr class="d-flex">
               <td class="col-2">Read</td>
               <td class="col-5">READ ALL records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-success"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Edit</td>
               <td class="col-5">EDIT ALL records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-success"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Add</td>
               <td class="col-5">ADD new records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-success"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Delete</td>
               <td class="col-5">DELETE ALL records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-success"><i class="fas fa-fw fa-check-square"></i></td>
            </tr>
            <tr class="d-flex bg-dark">
               <td class="col-12"></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Read Own</td>
               <td class="col-5">READ authored records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-info"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Edit Own</td>
               <td class="col-5">EDIT authored records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-info"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Trash Own</td>
               <td class="col-5">TRASH authored records</td>
               <td class="col-1 text-center text-secondary"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex text-danger">
               <td class="col-2">Restore Own</td>
               <td class="col-5">RESTORE authored records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Private \ Public Own</td>
               <td class="col-5">PRIVATIZE or PUBLICIZE authored records</td>
               <td class="col-1 text-center text-secondary"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex bg-dark">
               <td class="col-12"></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Publish \ Unpublish All</td>
               <td class="col-5">PUBLISH or UNPUBLISH records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-secondary"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Restore All</td>
               <td class="col-5">RESTORE ALL records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-secondary"><i class="fas fa-fw fa-check-square"></i></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Trash All</td>
               <td class="col-5">TRASH ALL records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-secondary"><i class="fas fa-fw fa-check-square"></i></td>
            </tr>
            <tr class="d-flex bg-dark">
               <td class="col-12"></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Unpublished Listings Page</td>
               <td class="col-5">View the UNPUBLISHED records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-secondary"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Trashed Listings Page</td>
               <td class="col-5">View the TRASHED records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-secondary"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">New Listings Page</td>
               <td class="col-5">View the NEW records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-secondary"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Future Listings Page</td>
               <td class="col-5">View the FUTURE records</td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-secondary"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex bg-dark">
               <td class="col-12">Other (To be re-visited)</td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">Delete Image</td>
               <td class="col-5"></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-secondary"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
            <tr class="d-flex">
               <td class="col-2">View Image</td>
               <td class="col-5"></td>
               <td class="col-1 text-center text-secondary"><i class="fas fa-fw fa-check-square"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
               <td class="col-1 text-center text-danger"><i class="fas fa-fw fa-ban"></i></td>
            </tr>
         </tbody>
      </table>
   </div>

   <div class="card-footer p-2">
      <div class="row">
         <div class="col-sm-12 col-md-4">
            <table>
               <tr>
                  <th>Permissions Legend</th>
               </tr>
               <tr>
                  <td><i class="fas fa-fw fa-check-square text-success"></i> Access Granted</td>
               </tr>
               <tr>
                  <td><i class="fas fa-fw fa-ban text-danger"></i> Access Denied</td>
               </tr>
               <tr>
                  <td><i class="fas fa-fw fa-check-square text-secondary"></i> Access Granted Via Parent Permission</td>
               </tr>
               <tr>
                  <td><i class="fas fa-fw fa-check-square text-info"></i> Access Granted Via Integration</td>
               </tr>
            </table>
         </div>
         <div class="col-sm-12 col-md-8">
            <table>
               <tr>
                  <th>Notes</th>
               </tr>
               <tr>
                  <td>Authored records are records created by indivudual users.</td>
               </tr>
               <tr>
                  <td>All permissions apply to the category specific records. I.E.: Posts, Articles, Recipes</td>
               </tr>
               <tr>
                  <td></td>
               </tr>
               <tr>
                  <td></td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</div>

