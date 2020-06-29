@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.articles.blocks.sidebar')
   @include('admin.articles.blocks.archives')
@endsection

@section('content')

<form style="display:inline;">
   {!! csrf_field() !!}

   <div class="card mb-3">
      
      <!--CARD HEADER-->
      <div class="card-header section_header p-2">
         <i class="{{ Config::get('buttons.articles') }}"></i>
         Articles
         <div class="float-right">
            <div class="btn-group">
               @include('admin.articles.buttons.help', ['size'=>'xs', 'bookmark'=>'articles'])
               @include('admin.articles.buttons.unpublishAll', ['size'=>'xs'])
               @include('admin.articles.buttons.trashAll', ['size'=>'xs'])
               @include('admin.articles.buttons.add', ['size'=>'xs'])
            </div>
         </div>
      </div>

      <!-- ALPHABET -->
      <div class="text-center">
         <div class="btn-group p-1">
            <a href="{{ route('admin.articles.index') }}" class="{{ Request::is('admin/articles') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
            @foreach($letters as $value)
               <a href="{{ route('admin.articles.index', $value) }}" class="{{ Request::is('admin/articles/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
            @endforeach
         </div>
      </div>


      <!--CARD BODY-->
      <div class="card-body section_body p-2">

         @if($articles->count() > 0)
            <table id="datatable" class="table table-hover table-sm">
               <thead>
                  <tr>
                     <th class="no-sort"><input type="checkbox" id="selectall" class="checked" /></th>
                     <th>Title</th>
                     <th>Category</th>
                     <th>Views</th>
                     <th>Author</th>
                     <!-- Add columns below for search purposes only -->
                     <!-- Add columns above for search purposes only -->
                     <th>Created</th>
                     <th>Published</th>
                     <th class="no-sort"></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($articles as $article)
                     <tr>
                        <td><input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$article->id}}" class="check-all"></td>
                        <td><a href="{{ route('admin.articles.show', $article->id) }}">{{ $article->title }}</a></td>
                        <td>{{ $article->category }}</td>
                        <td>{{ $article->views }}</td>
                        <td>@include('common.authorFormat', ['model'=>$article, 'field'=>'user'])</td>
                        <!-- Add columns below for search purposes only -->
                        <!-- Add columns above for search purposes only -->
                        <td data-order="{{ $article->created_at }}">{{ $article->created_at }}</td>
                        <td data-order="{{ $article->published_at }}">{{ $article->published_at }}</td>
                        <td>
                           <div class="float-right">
                              <div class="btn-group">
                                 @include('admin.articles.buttons.audits', ['size'=>'xs'])
                                 @include('admin.articles.buttons.publish', ['size'=>'xs'])
                                 @include('admin.articles.buttons.edit', ['size'=>'xs'])
                                 @include('admin.articles.buttons.trash', ['size'=>'xs'])
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
