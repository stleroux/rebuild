@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.movies.blocks.sidebar')
   @include('admin.movies.blocks.search')
   @include('admin.movies.blocks.archives')
@endsection

@section('content')

<form style="display:inline;">
   {!! csrf_field() !!}

   <div class="card mb-3">
      
      <!--CARD HEADER-->
      <div class="card-header section_header p-2">
         <i class="{{ Config::get('buttons.movies') }}"></i>
         Movies
         <div class="float-right">
            <div class="btn-group">
               @include('admin.movies.buttons.help', ['size'=>'xs', 'bookmark'=>'movies'])
               @include('admin.movies.buttons.unpublishAll', ['size'=>'sm'])
               @include('admin.movies.buttons.trashAll', ['size'=>'sm'])
               @include('admin.movies.buttons.add', ['size'=>'xs'])
            </div>
         </div>
      </div>

<!-- ALPHABET -->
<div class="text-center">
   <div class="btn-group p-1">
      <a href="{{ route('admin.movies.index') }}" class="{{ Request::is('admin/movies') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
      @foreach($letters as $value)
         <a href="{{ route('admin.movies.index', $value) }}" class="{{ Request::is('admin/movies/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
      @endforeach
   </div>
</div>


      <!--CARD BODY-->
      <div class="card-body section_body p-2">
         @if($movies->count() > 0)
            <table id="" class="table table-hover table-sm">
               <thead>
                  <tr>
                     <th></th>
                     <th>@sortablelink('title', 'Title')</th>
                     <th>@sortablelink('category', 'Genre')</th>
                     <th>@sortablelink('running_time', 'Runtime')</th>
                     <th>@sortablelink('views', 'Views')</th>
                     <th>@sortablelink('col_no', "ColNo")</th>
                     <th>IMDB N<sup>o</sup></th>
                     <th>@sortablelink('created_at','Created')</th>
                     <th>@sortablelink('published_at','Published')</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($movies as $movie)
                     <tr>
                        <td><input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$movie->id}}" class="check-all"></td>
                        <td><a href="{{ route('admin.movies.show', $movie->id) }}">{{ $movie->title }}</a></td>
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
                        <td data-order="{{ $movie->published_at}}">{{ $movie->published_at }}</td>
                        <td>
                           <div class="float-right">
                              <div class="btn-group">
                                 @include('admin.movies.buttons.publish', ['size'=>'xs'])
                                 @include('admin.movies.buttons.edit', ['size'=>'xs'])
                                 @include('admin.movies.buttons.trash', ['size'=>'xs'])
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
</form>
@endsection
