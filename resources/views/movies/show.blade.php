@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('movies.blocks.popular')
   @include('movies.blocks.archives')
@endsection

@section('content')
   
   <div class="card mb-3">

      <div class="card-header section_header p-2">
         <div class="row p-0 m-0">
            <div class="col-sm-12 col-md-12 col-lg-4 px-0">
               <i class="{{ Config::get('buttons.movies') }}"></i>
               {{ $movie->title }}
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 px-0">
               @if(Route::currentRouteName() != "movies.search")
                  <div class="text-center">
                     <div class="btn-group">
                        @include('movies.buttons.previous', ['size'=>'xs', 'btn_label'=>'Previous', $previous])
                        @include('movies.buttons.next', ['size'=>'xs', 'btn_label'=>'Next', $next])
                     </div>
                  </div>
               @endif
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 px-0">
               <div class="text-right">
                  <div class="btn-group">
                     @include('movies.buttons.back', ['size'=>'xs', 'btn_label'=>'Back'])
                     {{-- @include('movies.buttons.print', ['size'=>'xs', 'btn_label'=>'Print']) --}}
                     {{-- @include('movies.buttons.printPDF', ['size'=>'xs', 'btn_label'=>'Print PDF']) --}}
                     @include('movies.buttons.favorite', ['size'=>'xs', 'btn_label'=>'Favorite'])
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="card-body section_body p-2">

         <div class="form-row">
            
            <div class="col">
            
               <div class="card mb-2">
                  <div class="card-header p-1 m-0">Title</div>
                  <div class="card-body p-1 m-0">{{ $movie->title }}</div>
               </div>

               <div class="form-row">
                  <div class="col">
                     <div class="card mb-2">
                        <div class="card-header p-1 m-0">Collection No</div>
                        <div class="card-body p-1 m-0">{{ $movie->col_no }}</div>
                     </div>
                  </div> <!-- end col -->
                  <div class="col">
                     <div class="card mb-2">
                        <div class="card-header p-1 m-0">Views</div>
                        <div class="card-body p-1 m-0">{{ $movie->views }}</div>
                     </div>
                  </div> <!-- end col -->
                  <div class="col">
                     <div class="card mb-2">
                        <div class="card-header p-1 m-0">Category</div>
                        <div class="card-body p-1 m-0">{{ $movie->category }}</div>
                     </div>
                  </div> <!-- end col -->
               </div> <!-- end row -->

               <div class="form-row">
                  <div class="col">
                     <div class="card mb-2">
                        <div class="card-header p-1 m-0">Production Year</div>
                        <div class="card-body p-1 m-0">{{ $movie->production_year }}</div>
                     </div>
                  </div> <!-- end col -->
                  <div class="col">
                     <div class="card mb-2">
                        <div class="card-header p-1 m-0">Running Time</div>
                        <div class="card-body p-1 m-0">{{ $movie->running_time }} minutes</div>
                     </div>
                  </div> <!-- end col -->
                  <div class="col">
                     <div class="card mb-2">
                        <div class="card-header p-1 m-0">IMDB N<sup>o</sup></div>
                        <div class="card-body p-1 m-0">
                           @if($movie->original_title)
                              <a href="https://www.imdb.com/title/{{ $movie->original_title }}" target="_blank">{{ $movie->original_title }}</a>
                           @endif
                        </div>
                     </div>
                  </div> <!-- end col -->
               </div> <!-- end row -->

               <div class="form-row">
                  <div class="col">
                     <div class="card mb-2">
                        <div class="card-header p-1 m-0">Overview</div>
                        <div class="card-body p-1 m-0">{!! $movie->overview !!}</div>
                     </div>
                  </div> <!-- end col -->
               </div> <!-- end row -->
            </div> <!-- end left col -->
            
            <div class="col">
               <div><img src="\_movies\{{str_replace('-', '', $movie->upc) }}f.jpg" /></div>
            </div> <!-- end right col -->

         </div> <!-- end row -->
      </div> <!-- end of main card body -->
   </div> <!-- end of main card -->
   
@endsection
