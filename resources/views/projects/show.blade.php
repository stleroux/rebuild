@extends('layouts.master')

@section('stylesheets')
   {{-- {{ Html::style('css/.css') }} --}}
   <style type="text/css">
      #myCarousel .list-inline {
    white-space:nowrap;
    overflow-x:auto;
}

#myCarousel .carousel-indicators {
    position: static;
    left: initial;
    width: initial;
    margin-left: initial;
}

#myCarousel .carousel-indicators > li {
    width: initial;
    height: initial;
    text-indent: initial;
}

#myCarousel .carousel-indicators > li.active img {
    opacity: 0.7;
}
   </style>
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
  @include('projects.blocks.leave_comment')
  @include('projects.blocks.imageSlider')
@endsection

@section('content')
   
   <div class="card mb-3">

      <div class="card-header">
         <i class="fa fa-plus-square"></i>
         Show Project
         <span class="float-right">
            @include('projects.addins.links.help', ['model'=>'project', 'bookmark'=>'projects'])
            @include('projects.addins.links.back', ['model'=>'project'])
         </span>
      </div>

      <div class="card-body p-1">
         <div class="w-100 jumbotron text text-center p-0 m-0">
            @if($image)
               <img src="/_projects/{{ $image->name }}" alt="{{ $project->name}}" height="100%" width="95%">
            @else
               <img src="/images/no_image.jpg" alt="No Image" height="100%" width="95%">
            @endif
         </div>

      </div>

   </div>








@endsection
