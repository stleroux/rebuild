{{-- IMAGES APPLIED --}}




<div class="card mb-2">
   <div class="card-header p-1">
      Images Information
      {{-- <span class="float-right">
         <a class="" data-toggle="collapse" href="#addImage" role="button" aria-expanded="false" aria-controls="addImage">
          <i class="{{ Config::get('buttons.add') }}"></i>
        </a>
      </span> --}}
      <a id="showAddImage" class="btn-link"><i class="{{ Config::get('buttons.add') }}"></i></a>
   </div>
   {{-- <div class="card-body p-2"> --}}
      <div class="form-row pt-0">


{{-- <p id="test">Hello</p>
<p id="test" style="display: none">Good Bye</p> --}}
 


  
<div class="col-xs-12 col-md-12" id="test" style="display: none;">
   <div class="collapse pt-0">
      <div class="card-body p-2">
         <form action="{{ route('projects.addImage', $project->id) }}" method="post" enctype="multipart/form-data" class="form-inline">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            {{ Form::file('image', ['class'=>'form-control form-control-sm p-0 col-10']) }}
            <span class="text-danger">{{ $errors->first('image') }}</span>
            <button type="submit" class="btn btn-sm btn-primary col-2 float-right">Add</button>
         </form>
      </div>
   </div>
</div>

{{--          <div class="col-xs-12 col-md-12">
            <div class="card p-0">
               <div class="card-body p-2 text-center">
                  <form action="{{ route('projects.addImage', $project->id) }}" method="post" enctype="multipart/form-data" class="form-inline">
                     <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                     {{ Form::file('image', ['class'=>'form-control form-control-sm p-0']) }}
                     <span class="text-danger">{{ $errors->first('image') }}</span>
                     <button type="submit" class="btn btn-sm btn-primary">Add</button>
                  </form>
               </div>
            </div>
         </div> --}}

         <div class="col-xs-12 col-md-12" id="test">
            @if(count($project->images) > 0)
               <table class="table table-sm table-hover">
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




         {{-- <div class="col-xs-12 col-md-12">
            <div class="card p-0">
               <div class="card-header p-1">
                  Add new image
               </div>
               <div class="card-body p-2 text-center">
                  <form action="{{ route('projects.addImage', $project->id) }}" method="post" enctype="multipart/form-data">
                     <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                     {{ Form::file('image', ['class'=>'form-control form-control-sm p-0']) }}
                     <span class="text-danger">{{ $errors->first('image') }}</span>
                     <button type="submit" class="btn btn-sm btn-primary">Add New Image</button>
                  </form>
               </div>
            </div>
         </div> --}}

      </div>
   {{-- </div> --}}
</div>

