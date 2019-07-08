{{-- IMAGES APPLIED --}}
<div class="card mb-2">

   <div class="card-header p-1">
      Images Information
      <a id="showAddImage" class="btn btn-xs float-right"><i class="{{ Config::get('buttons.add') }}"></i></a>
   </div>
   
   <div class="card-body p-0">
   
      <div class="form-row">
   
         <div id="addImage" class="col-10 offset-1 pt-2" style="display: none;">
            <div class="card mb-2">
               <div class="card-header pl-2 pt-0 py-0">Add Image</div>
               <div class="card-body p-2">
                  <form action="{{ route('projects.addImage', $project->id) }}" method="post" enctype="multipart/form-data" class="form-inline">
                     <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                     {{ Form::file('image', ['class'=>'form-control form-control-sm p-0 col-9']) }}
                     <span class="text-danger">{{ $errors->first('image') }}</span>
                     <button type="submit" class="btn btn-sm btn-primary col-2 float-right col-1 offset-1">Add</button>
                  </form>
               </div>
            </div>
         </div>

         <div id="addImage" class="col-xs-12 col-md-12">
            @if(count($project->images) > 0)
               <table class="table table-sm table-hover mb-0">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($project->images as $key => $image)
                        <tr>
                           <td>{{$key+1}}</td>
                           <td><a href="{{ asset('_projects/'.$image->name) }}">{{$image->name}}</a></td>
                           <td>
                              <form action="{{ route('projects.removeImage', $image->id) }}" method="POST" class="float-right">
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

      </div>

   </div>

</div>

<script>
   $(document).ready(function(){
      $("a#showAddImage").click(function(){
         $("div#addImage").toggle();
      });
   });
</script>
