{{-- FINISHES APPLIED --}}
<div class="card mb-2">
   <div class="card-header p-1">Finishes Information</div>
   {{-- <div class="card-body p-2"> --}}
      <div class="form-row pt-2">
         
         <div class="col-xs-12 col-md-7">
            @if($project->finishes()->count() > 0)
            <table class="table table-sm table-hover">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Finish</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($project->finishes as $key => $value)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->name}}</td>
                        <td>
                           <form action="{{ route('projects.removeFinish', $value->id) }}" method="POST" class="float-right">
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
                  Add new finish
               </div>
               <div class="card-body p-2 text-center">
                  <form action="{{ route('projects.addFinish', $project->id) }}" method="post">
                     <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                     <select name="finish" id="finish" class="form-control form-control-sm mb-2">
                        <option value="">Select</option>
                        @foreach($finishes as $finish)
                           <option value="{{$finish->id}}">{{$finish->name}}</option>
                        @endforeach
                     </select>
                     <button type="submit" class="btn btn-sm btn-primary">Add New Finish</button>
                  </form>
               </div>
            </div>
            
         </div>

      </div>
   {{-- </div> --}}
</div>