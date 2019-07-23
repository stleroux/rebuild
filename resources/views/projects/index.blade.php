@extends('layouts.master')

@section('title','Woodshop Projects')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('projects.blocks.popularProjects')
@endsection

@section('content')

   <div class="card mb-3">
      <div class="card-header section_header">
         <i class="fab fa-pagelines"></i>
         Projects
         {{-- <span class="float-right">
            @include('projects.addins.links.help', ['bookmark'=>'projects'])
            @include('projects.addins.links.BEProjects')
            @include('projects.finishes.addins.links.finishes')
            @include('projects.materials.addins.links.materials')
            @include('projects.addins.links.add', ['model'=>'project'])
         </span> --}}
      </div>
      <div class="card-body section_body pb-0">

         <div class="pb-1">
            @foreach($project->categoriesOptions() as $categoryOptionKey => $categoryOptionValue)
               @if($categoryOptionKey == 0)
                  <a href="{{ route('projects.index') }}"
                     class="btn btn-sm btn-{{ request()->is('projects') ? 'primary' : 'secondary' }}">
                     All Projects
                  </a>
               @else
                  <a href="{{ route('projects.index', $categoryOptionKey) }}"
                     class="btn btn-sm btn-{{ request()->is('projects/'.$categoryOptionKey) ? 'primary' : 'secondary' }} p-1">
                     {{ $categoryOptionValue }}
                  </a>
               @endif
            @endforeach
         </div>

         @if(count($projects) > 0)
            <div class="px-2">
               <div class="row mb-1">
                  @foreach($projects as $project)
                     <div id="card-hover" class="col-xs-12 col-md-3 p-1">
                        <div class="card h-100 w-100">
                           <div class="h-100 thumbnail p-2 text text-center" style="background-image: url('../images/nav.jpg');">
                              <a href="{{ route('projects.show', $project->id) }}">
                                 @if($project->images->count() > 0)
                                    <img src="/_projects/{{ $project->id }}/thumbs/{{ $project->images[0]->name }}" alt="{{ $project->name}}" class="mx-auto mw-100" />
                                 @else
                                    <img src="/images/no_image.jpg" alt="No Image" height="150px" width="95%" />
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
                           </div>
                        </div>
                     </div>
                  @endforeach
               </div>

               @if(url()->current() != "http://192.168.0.12/projects/1000")
                  <div class="pb-1">
                     {{ $projects->links() }}
                  </div>
               @endif

            </div>
         @else
            <p>No projects found</p>
         @endif
      </div>
      <div class="card-footer pt-1 pb-1 pl-2">
         Click a project's image to view it's details
      </div>
   </div>

@endsection
