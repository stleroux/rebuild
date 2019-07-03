{{-- MATERIALS USED --}}
<div class="card mb-2">
   <div class="card-header p-1">Materials Information</div>
   {{-- <div class="card-body p-2"> --}}
      <div class="form-row pt-2">
         
         <div class="col-xs-12 col-md-7">
            @if($project->materials()->count() > 0)
               <table class="table table-sm table-hover">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Material</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($project->materials as $key => $material)
                        <tr>
                           <td>{{$key+1}}</td>
                           <td>{{$material->name}}</td>
                           <td>
                              <form action="{{ route('projects.removeMaterial', $material->id) }}" method="POST" class="float-right">
                                 {{csrf_field()}}
                                 {{ method_field('DELETE') }}
                                 <input type="hidden" value="{{ $project->id }}" name="project_id">
                                 <button type="submit" class="btn btn-xs btn-danger">
                                    <i class="fa fa-trash"></i>
                                 </button>
                              </form>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            @else
               &nbsp;No entries found
            @endif
         </div>

         <div class="col-xs-12 col-md-5">
            <div class="card p-0">
               <div class="card-header p-1">
                  Add new material
               </div>
               <div class="card-body p-2 text-center">
                  <form action="{{ route('projects.addMaterial', $project->id) }}" method="post">
                  {{-- <form action="{{ route('projects.addMaterial', $project->id) }}" method="post"> --}}
                     <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                     <select name="material" id="material" class="form-control form-control-sm mb-2">
                        <option value="">Select</option>
                        @foreach($materials as $material)
                           <option value="{{$material->id}}">{{$material->name}}</option>
                        @endforeach
                     </select>
                     <button type="submit" class="btn btn-sm btn-primary">Add New Material</button>
                  </form>
               </div>
            </div>
            
         </div>

      </div>
   {{-- </div> --}}
</div>
