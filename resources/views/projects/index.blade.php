@extends('layouts.master')

@section('title','Woodshop Projects')

@section('stylesheets')
   {{ Html::style('css/frontend.css') }}
@stop

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   most popular
@endsection

@section('content')

   <div class="card">
      <div class="card-header">
         <i class="fab fa-pagelines"></i>
         Projects
         <span class="float-right">
            @include('projects.addins.links.help', ['bookmark'=>'projects'])
            @include('projects.addins.links.BEProjects')
            @include('projects.finishes.addins.links.finishes')
            @include('projects.materials.addins.links.materials')
            @include('projects.addins.links.add', ['model'=>'project'])
         </span>
      </div>
      <div class="card-body" style="background-image: url('../images/board_2.jpg');">
         @if(count($projects) > 0)

            @foreach ($projects->chunk(4) as $chunk)
               <div class="row">
                  @foreach ($chunk as $project)
                     <div class="col-xs-12 col-sm-3">
                        <div class="thumbnail p-2 text text-center" style="background-image: url('../images/nav.jpg');">
                           
                              <a href="{{ route('projects.show', $project->id) }}">
                                 {{-- <img src="/_woodProjects/main_images/thumbs/{{ $project->main_image }}" alt="{{ $project->name}}"> --}}
                                 @if($project->images->count() > 0)
                                    <img src="/_projects/{{ $project->images[0]->name }}" alt="{{ $project->name}}" height="150px" width="95%">
                                 @else
                                    <img src="/images/no_image.jpg" alt="No Image" height="150px" width="95%">
                                 @endif
                              </a>
                           
                           <h4 class="text-center" style="color:black">{{ $project->name}}</h4>
                           <div class="text-center" style="color:black"><strong>Category</strong> : {{ $project->category }}</div>
                           <div class="text-center" style="color:black"><strong>Views</strong> : {{ $project->views }}</div>
                           <div class="text text-center">
                              <span class="badge text text-center" style="color:black">
                                 @if(count($project->images) > 0)
                                    {{ count($project->images) }} 
                                    {{ count($project->images) > 1 ? 'images' : 'image' }}
                                 @else
                                    No Images
                                 @endif
                              </span>
                           </div>
                           {{-- <div class="caption text-center">
                              <h3></h3>
                              <p class="label label-default">{{ $project->category->name }}</p>
                              <p class="badge">
                                 @if(count($project->projectImages) > 0)
                                    {{ count($project->projectImages) }} 
                                       @if(count($project->projectImages) > 1)
                                          images
                                       @else
                                          image
                                       @endif
                                    
                                 @endif
                              </p>

                           </div> --}}
                              {{-- <a href="{{ route('backend.photos.create', $album->id) }}" class="btn btn-xs btn-primary">Add Photo</a>
                              {!! Form::open(['action' => ['Backend\AlbumsController@destroy', $album->id], 'method'=>'POST', 'style'=>'display:inline;', 'onsubmit' => 'return confirm("Are you sure you want to delete the Album AND all photos in it?")']) !!}
                                 {{ Form::hidden('_method', 'DELETE') }}
                                 {!! Form::submit('Delete Album', ['class'=>'btn btn-xs btn-danger pull-right']) !!}
                              {!! Form::close() !!} --}}
                        </div>
                     </div>
                   @endforeach
                </div>
            @endforeach

         @else
            <p>No projects found</p>
         @endif
      </div>
      <div class="card-footer pt-1 pb-1 pl-2">
         Click a project to view it's details
      </div>
   </div>

@endsection
