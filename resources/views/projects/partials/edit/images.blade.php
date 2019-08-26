{{-- IMAGES APPLIED --}}
<div class="card mb-2">

   <div class="card-header card_header p-1 {{ (($errors->first('image')) || $errors->first('image_description')) ? 'text-danger' : '' }}" id="showAddImage">
      
      Images Information
      {{-- <a class="btn btn-xs float-right"><i class="{{ Config::get('buttons.add') }}"></i></a> --}}
      <a class="btn btn-xs float-right">
         <i id="icon" class="fas fa-sort-down"></i>
      </a>
   </div>
   
   <div class="card-body section_body p-0">
   
      <div class="form-row">
   
         <div id="addImage" class="col-10 offset-1 pt-2" style="display: none;">
            <div class="card mb-2">
               <div class="card-header p-2">Add Image</div>
               <div class="card-body p-2">
                  {{-- <form action="{{ route('projects.addImage', $project->id) }}" method="post" enctype="multipart/form-data" > --}}
                  <form action="{{ route('projects.image.store', $project->id) }}" method="post" enctype="multipart/form-data" >
                     <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

                     {{-- <div class="col-sm-12"> --}}
                        <div class="form-group pb-2 mb-0">
                           {{ Form::label('image', 'Image', ['class'=>'required']) }}
                           {{ Form::file('image', ['class'=>'form-control form-control-sm p-0']) }}
                           <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>
                     {{-- </div> --}}

                     {{-- <div class="col-sm-12"> --}}
                        <div class="form-group pb-2 mb-0">
                           {{ Form::label('image_description', 'Desciption', ['class'=>'required']) }}
                           {{ Form::textarea('image_description', null, ['id' => 'image_description', 'rows' => 4, 'cols' => 20, 'class'=>'form-control form-control-sm p-0']) }}
                           <span class="text-danger">{{ $errors->first('image_description') }}</span>
                        </div>
                     {{-- </div> --}}

                     {{-- <div class="col-sm-12"> --}}
                        <div class="form-group pb-0 mb-0">
                           <button type="submit" class="btn btn-sm btn-secondary btn-block">Add</button>
                        </div>
                     {{-- </div> --}}

                  </form>
               </div>
            </div>
         </div>

         <div id="addImage" class="col-xs-12 col-md-12">
            @if(count($project->images) > 0)
               <table class="table table-sm table-hover table-striped text-light mb-0">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Image</th>
                        {{-- <th>Main</th> --}}
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($project->images as $key => $image)
                        <tr>
                           <td>{{$key+1}}</td>
                           <td>{{ $image->name }}</td>
                           <td>
                              <form action="{{ route('projects.image.delete', $image->id) }}" method="POST" class="float-right">
                                 {{csrf_field()}}
                                 {{ method_field('DELETE') }}
                                 <div class="btn-group">
                                    <a href="javascript:;"
                                       data-href="/_projects/{{ $image->project_id }}/{{ $image->name }}"
                                       data-name="{{ $image->name }}"
                                       data-description="{{ $image->description }}"
                                       class="openmodal btn btn-xs btn-primary text-light">
                                       <i class="far fa-eye"></i>
                                    </a>
                                    <input type="hidden" value="{{ $project->id }}" name="project_id">
                                    <button type="submit" class="btn btn-xs btn-danger text-light">
                                       <i class="fa fa-trash"></i>
                                    </button>
                                 </div>
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


<!-- Modal -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 id="title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body text-center">
            <img src="" class="mx-auto mw-100" />
            <p id="description"></p>
         </div>
         <div class="modal-footer p-1">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>
   $(document).ready(function(){
      $("div#showAddImage").click(function(){
         $("div#addImage").toggle();
         $("i#icon", this).toggleClass("fas fa-caret-up fas fa-sort-down");
      });
      $('div#showAddImage').css('cursor', 'pointer');
   });

   $(".openmodal").click(function(){
      var href = $(this).data("href");
      var name = $(this).data('name');
      var description = $(this).data('description');
      $("#imagemodal img").attr("src",href);
      $(".modal-header #title").text(name);
      $(".modal-body #description").text(description);
      $("#imagemodal").modal("show");
   });
</script>
