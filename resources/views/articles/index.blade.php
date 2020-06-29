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

   <div class="card mb-3">

      <!--CARD HEADER-->
      <div class="card-header section_header p-2">
         <i class="{{ Config::get('buttons.articles') }}"></i>
         Articles
         <div class="float-right">
            @include('articles.buttons.myFavorites', ['size'=>'xs', 'btn_label'=>'My Favorites'])
         </div>
      </div>

      <!-- ALPHABET -->
      <div class="text-center">
         <div class="btn-group p-1">
            <a href="{{ route('articles.index') }}" class="{{ Request::is('articles') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
            @foreach($letters as $value)
               <a href="{{ route('articles.index', $value) }}" class="{{ Request::is('articles/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
            @endforeach
         </div>
      </div>

      <!--CARD BODY-->
      <div class="card-body section_body p-2">
         @if($articles->count() > 0)
            <table id="datatable" class="table table-hover table-sm">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Category</th>
                     <th>Views</th>
                     <!-- Add columns below for search purposes only -->
                     <th class="d-none"></th>
                     <th class="d-none"></th>
                     <!-- Add columns above for search purposes only -->
                     <th>Author</th>
                     <th>Created</th>
                     <th data-orderable="false"></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($articles as $article)
                     <tr>
                        <td>{{ $article->id }}</td>
                        <td><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></td>
                        <td>{{ $article->category }}</td>
                        <td>{{ $article->views }}</td>
                           <!-- Add columns below for search purposes only -->
                           <td class="d-none">{{ $article->description_eng }}</td>
                           <td class="d-none">{{ $article->description_fre }}</td>
                           <!-- Add columns above for search purposes only -->
                        <td>@include('common.authorFormat', ['model'=>$article, 'field'=>'user'])</td>
                        <td data-order="{{ $article->created_at}}">{{ $article->created_at }}</td>
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

@endsection
