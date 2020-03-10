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

   <form style="display:inline;">
      {!! csrf_field() !!}

         <div class="card mb-3">
            <div class="card-header section_header p-2">
               <i class="{{ Config::get('buttons.movies') }}"></i>
               My Favorite Movies
               <span class="float-right">
                  <div class="btn-group">
                     @include('movies.buttons.back', ['size'=>'xs', 'btn_label'=>'Back'])
                  </div>
               </span>
            </div>
         
            <div class="card-body section_body p-2">
               @if($movies->count())
                  <table id="datatable" class="table table-hover table-sm searchHighlight">
                     <thead>
                        <tr>
                           {{-- Add columns for search purposes only --}}
                           <th class="d-none">English</th>
                           <th class="d-none">French</th>
                           {{-- Add columns for search purposes only --}}

                           <th class="">Title</th>
                           <th class="">Category</th>
                           <th class="">Views</th>
                           <th class="">Author</th>
                           <th class="">Created On</th>
                           <th class="">Publish(ed) On</th>
                           <th class="" data-orderable="false"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($movies as $key => $movie)
                           <tr>
                              {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
                              <td class="d-none">{{ $movie->description_eng }}</td>
                              <td class="d-none">{{ $movie->description_fre }}</td>
                              {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
                              
                              <td><a href="{{ route('movies.show', $movie->id) }}" class="">{{ $movie->title }}</a></td>
                              <td class="">{{ $movie->category }}</td>
                              <td class="">{{ $movie->views }}</td>
                              <td class="">@include('common.authorFormat', ['model'=>$movie, 'field'=>'user'])</td>
                              <td class="">@include('common.dateFormat', ['model'=>$movie, 'field'=>'created_at'])</td>
                              <td class=" 
                                 {{ $movie->published_at <= Carbon\Carbon::now() ? 'text text-warning' : '' }}
                                 {{ $movie->published_at == null ? 'text text-info' : '' }}">
                                 {{-- @include('common.dateFormat', ['model'=>$movie, 'field'=>'published_at']) --}}
                                 {{ $movie->published_at }}
                              </td>
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
               @else
                  {{ setting('no_records_found') }}
               @endif
            </div>
         </div>
   </form>
      
@endsection
