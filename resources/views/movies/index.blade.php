@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('movies.blocks.popular')
   @include('movies.blocks.search')
   @include('movies.blocks.archives')
@endsection

@section('content')

   <div class="card mb-3">
      <!--CARD HEADER-->
      <div class="card-header section_header p-2">
         <i class="{{ Config::get('buttons.movies') }}"></i>
         @if (Route::currentRouteName() == "movies.search")
            Movies :: Search Results for "{{ $search }}"
         @else
            Movies
         @endif
         <div class="float-right">
            @include('movies.buttons.myFavorites', ['size'=>'xs', 'btn_label'=>'My Favorites'])
         </div>
      </div>

      <!-- ALPHABET -->
      <div class="text-center">
         <div class="btn-group p-1">
            <a href="{{ route('movies.index') }}" class="{{ Request::is('movies') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
            @foreach($letters as $value)
               <a href="{{ route('movies.index', $value) }}" class="{{ Request::is('movies/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
            @endforeach
         </div>
      </div>

      <!--CARD BODY-->
      <div class="card-body section_body p-2">
         @if($movies->count() > 0)
            <table id="" class="table table-hover table-sm">
               <thead>
                  <tr>
                     <th>@sortablelink('title', 'Title')</th>
                     <th>@sortablelink('category', 'Genre')</th>
                     <th>@sortablelink('running_time', 'Runtime')</th>
                     <th>@sortablelink('views', 'Views')</th>
                     <th>@sortablelink('col_no', "ColNo")</th>
                     <th>IMDB</th>
                     <th>@sortablelink('created_at','Created')</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($movies as $movie)
                     <tr>
                        <td><a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a></td>
                        <td>{{ $movie->category }}</td>
                        <td>{{ $movie->running_time }}</td>
                        <td>{{ $movie->views }}</td>
                        <td>{{ $movie->col_no }}</td>
                        <td>
                           @if($movie->original_title)
                              <a href="https://www.imdb.com/title/{{ $movie->original_title }}" target="_blank">{{ $movie->original_title }}</a>
                           @endif
                        </td>
                        <td data-order="{{ $movie->created_at}}">{{ $movie->created_at }}</td>
                        <td>
                           <div class="float-right">
                              <div class="btn-group">
                                 @include('movies.buttons.favorite', ['size'=>'xs'])
                              </div>
                           </div>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
            {{-- {{ $movies->links() }} --}}
            {!! $movies->appends(\Request::except('page'))->render() !!}
         @else
            {{ setting('no_records_found') }}
         @endif
      </div>
      
   </div>

@endsection
