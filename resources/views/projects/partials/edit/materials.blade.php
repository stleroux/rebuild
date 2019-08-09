{{-- MATERIALS USED --}}
<div class="card mb-2">

   <div class="card-header card_header p-1 {{ ($errors->first('material')) ? 'text-danger' : '' }}" id="showAddMaterial">
      Materials Information
{{--       <a class="btn btn-xs float-right"><i class="{{ Config::get('buttons.add') }}"></i></a> --}}
      <a class="btn btn-xs float-right">
         <i id="icon" class="fas fa-sort-down"></i>
      </a>
   </div>
   
   <div class="card-body section_body p-0">
   
      <div class="form-row">
   
         <div id="addMaterial" class="col-10 offset-1 pt-2" style="display: none;">
            <div class="card mb-2">
               <div class="card-header p-2">Add Material</div>
               <div class="card-body p-2">
                  <form action="{{ route('projects.material.store', $project->id) }}" method="post">
                     <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                     

                     <div class="form-group pb-2 mb-0">
                        <select name="material" id="material" class="form-control form-control-sm p-0">
                           <option value="">Select</option>
                           @foreach($materials as $material)
                              <option value="{{$material->id}}">{{$material->name}}</option>
                           @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('material') }}</span>
                     </div>
                     
                     <div class="form-group pb-0 mb-0">
                        <button type="submit" class="btn btn-sm btn-secondary btn-block">Add</button>
                     </div>

                  </form>
               </div>
            </div>
         </div>

         <div id="addMaterial" class="col-xs-12 col-md-12">
            @if($project->materials()->count() > 0)
               <table class="table table-sm table-hover table-striped mb-0">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Material</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($project->materials as $key => $value)
                        <tr>
                           <td>{{$key+1}}</td>
                           <td>{{$value->name}}</td>
                           <td>
                              <form action="{{ route('projects.material.delete', $value->id) }}" method="POST" class="float-right">
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
               <div class="p-2">
                  No entries found
               </div>
            @endif
         </div>

      </div>

   </div>
   
</div>

<script>
   $(document).ready(function(){
      $("div#showAddMaterial").click(function(){
         $("div#addMaterial").toggle();
         $("i#icon", this).toggleClass("fas fa-caret-up fas fa-sort-down");
      });
      $('div#showAddMaterial').css('cursor', 'pointer');
   });
</script>
