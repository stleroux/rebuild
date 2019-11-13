@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('articles.blocks.popular')
   @include('articles.blocks.archives')
@endsection

@section('content')

   <form style="display:inline;">
      {!! csrf_field() !!}

         <div class="card mb-3">
            <div class="card-header section_header p-2">
               <i class="{{ Config::get('buttons.articles') }}"></i>
               My Favorite Articles
               <span class="float-right">
                  <div class="btn-group">
                     @include('articles.buttons.back', ['size'=>'xs', 'btn_label'=>'Back'])
                  </div>
               </span>
            </div>
         
            <div class="card-body section_body p-2">
               @if($articles->count())
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
                        @foreach ($articles as $key => $article)
                           <tr>
                              {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
                              <td class="d-none">{{ $article->description_eng }}</td>
                              <td class="d-none">{{ $article->description_fre }}</td>
                              {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
                              
                              <td><a href="{{ route('articles.show', $article->id) }}" class="">{{ $article->title }}</a></td>
                              <td class="">{{ $article->category }}</td>
                              <td class="">{{ $article->views }}</td>
                              <td class="">@include('common.authorFormat', ['model'=>$article, 'field'=>'user'])</td>
                              <td class="">@include('common.dateFormat', ['model'=>$article, 'field'=>'created_at'])</td>
                              <td class=" 
                                 {{ $article->published_at <= Carbon\Carbon::now() ? 'text text-warning' : '' }}
                                 {{ $article->published_at == null ? 'text text-info' : '' }}">
                                 {{-- @include('common.dateFormat', ['model'=>$article, 'field'=>'published_at']) --}}
                                 {{ $article->published_at }}
                              </td>
                              <td>
                                 <div class="float-right">
                                    <div class="btn-group">
                                       @include('articles.buttons.favorite', ['size'=>'xs'])
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
