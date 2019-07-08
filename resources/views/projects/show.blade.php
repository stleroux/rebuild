@extends('layouts.backend')

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
@endsection

@section('content')
   
{{--    <div class="card mb-3">

      <div class="card-header">
         <i class="fa fa-plus-square"></i>
         Show Project
         <span class="float-right">
            @include('projects.addins.links.help', ['model'=>'project', 'bookmark'=>'projects'])
            @include('projects.addins.links.back', ['model'=>'project'])
         </span>
      </div>

      <div class="card-body p-1">
         <div class="jumbotron text text-center">
            @if($project->images->count() > 0)
               <img src="/_projects/{{ $project->images[0]->name }}" alt="{{ $project->name}}" height="50%" width="50%">
            @else
               <img src="/images/no_image.jpg" alt="No Image" height="100%" width="95%">
            @endif
         </div>
         <p class="col-2 p-1">
            @if($project->images->count() > 0)
               <img src="/_projects/{{ $project->images[0]->name }}" alt="{{ $project->name}}" height="150px" width="95%">
            @else
               <img src="/images/no_image.jpg" alt="No Image" height="150px" width="95%">
            @endif
         </p>
      </div>

   </div> --}}







<div class="col-lg-4 offset-lg-8" id="slider">
            <div id="myCarousel" class="carousel slide">
                <div class="carousel-inner">
                    <div class="active item carousel-item" data-slide-number="0">
                        <img src="/_projects/{{ $project->images[0]->name }}" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="1">
                        <img src="http://placehold.it/1200x480/888/FFF" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="2">
                        <img src="http://placehold.it/1200x480&amp;text=three" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="3">
                        <img src="http://placehold.it/1200x480&amp;text=four" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="4">
                        <img src="http://placehold.it/1200x480&amp;text=five" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="5">
                        <img src="http://placehold.it/1200x480&amp;text=six" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="6">
                        <img src="http://placehold.it/1200x480&amp;text=seven" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="7">
                        <img src="http://placehold.it/1200x480&amp;text=eight" class="img-fluid">
                    </div>

                    <a class="carousel-control left pt-3" href="#myCarousel" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
                    <a class="carousel-control right pt-3" href="#myCarousel" data-slide="next"><i class="fas fa-chevron-right"></i></a>

                </div>


                <ul class="carousel-indicators list-inline">
                    <li class="list-inline-item active">
                        <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=one" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-1" data-slide-to="1" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=two" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-2" data-slide-to="2" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=three" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-3" data-slide-to="3" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=four" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-4" data-slide-to="4" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=five" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-5" data-slide-to="5" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=six" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-6" data-slide-to="6" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=seven" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-7" data-slide-to="7" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=eight" class="img-fluid">
                        </a>
                    </li>
                </ul>
        </div>
    </div>
@endsection
