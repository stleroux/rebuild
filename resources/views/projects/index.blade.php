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
      <div class="card-header section_header p-2">
         {{-- <span class="h5 align-middle pt-2"> --}}
            <i class="fab fa-pagelines"></i>
            Projects
         {{-- </span> --}}
         {{-- <span class="float-right">
            @include('projects.addins.links.help', ['bookmark'=>'projects'])
            @include('projects.addins.links.BEProjects')
            @include('projects.finishes.addins.links.finishes')
            @include('projects.materials.addins.links.materials')
            @include('projects.addins.links.add', ['model'=>'project'])
         </span> --}}
      </div>
      <div class="card-body section_body p-2">

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
               <div class="row mb-0">
                  @foreach($projects as $project)
                     <div id="card-hover" class="col-xs-12 col-md-3 p-2">
                        <div class="card h-100 w-100">
                           <div class="h-100 thumbnail p-2 text-center" style="background-image: url('../images/nav.jpg');">
                              <a href="{{ route('projects.show', $project->id) }}">
                                 @if($project->images->count() > 0)
                                    <img src="/_projects/{{ $project->id }}/thumbs/{{ $project->images[0]->name }}" alt="{{ $project->name}}" class="mx-auto mw-100" />
                                 @else
                                    <img src="/images/no_image.jpg" alt="No Image" height="150px" width="95%" />
                                 @endif
                              </a>
                              <h4 class="text-light badge-dark p-1">{{ $project->name}}</h4>
                              <div class="text-dark"><strong>Category</strong> : {{ $project->category }}</div>
                              <div class="text-dark"><strong>Views</strong> : {{ $project->views }}</div>
                              <div class="text-dark"><strong>Comments</strong> : {{ $project->comments->count() }}</div>
                              <div class="text-dark">
                                 <span>
                                    @if(count($project->images) > 0)
                                       <strong>{{ count($project->images) > 1 ? 'Images' : 'Image' }} : </strong>
                                       {{ count($project->images) }} 
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
               @if (strpos($_SERVER['REQUEST_URI'], "1000") === false)
                  {{ $projects->links() }}
               @endif
            </div>
         @else
            <p class="p-2">No projects found</p>
         @endif
      </div>
      <div class="card-footer card_footer px-2 py-1">
         Click a project's image to view it's details
      </div>
   </div>

@endsection
