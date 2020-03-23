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

         <div class="card-header section_header p-2">
            <i class="{{ Config::get('buttons.mine') }}"></i>
            My Articles
            <span class="float-right">
               <div class="btn-group">
                  @include('admin.articles.buttons.help', ['size'=>'xs', 'bookmark'=>''])
                  @include('admin.articles.buttons.unpublishAll', ['size'=>'xs'])
                  @include('admin.articles.buttons.trashAll', ['size'=>'xs'])
                  @include('admin.articles.buttons.add', ['size'=>'xs'])
               </div>
            </span>
         </div>

         @if($articles->count())
            <div class="text-center">
               <div class="btn-group p-1">
                  <a href="{{ route('admin.articles.myArticles') }}" class="{{ Request::is('admin/articles/myArticles') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
                  @foreach($letters as $value)
                     <a href="{{ route('admin.articles.myArticles', $value) }}" class="{{ Request::is('admin/articles/myArticles/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
                  @endforeach
               </div>
            </div>
         @endif

         <div class="card-body section_body p-2">
            
            @if($articles->count())
               <table id="datatable" class="table table-hover table-sm searchHighlight">
                  <thead>
                     <tr>
                        <th><input type="checkbox" id="selectall" class="checked" /></th>
                        {{-- Add columns for search purposes only --}}
                           {{-- <th class="d-none">English</th> --}}
                           {{-- <th class="d-none">French</th> --}}
                        {{-- Add columns for search purposes only --}}
                        <th>Title</th>
                        <th class="">Category</th>
                        <th class="">Views</th>
                        <th class="">Author</th>
                        <th class="">Created On</th>
                        <th class="">Publish(ed) On</th>
                        <th data-orderable="false"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($articles as $key => $article)
                        <tr>
                           <td>
                              <input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$article->id}}" class="check-all">
                           </td>
                           {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
                              {{-- <td class="d-none">{{ $article->description_eng }}</td> --}}
                              {{-- <td class="d-none">{{ $article->description_fre }}</td> --}}
                           {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
                           <td><a href="{{ route('admin.articles.show', $article->id) }}" class="">{{ $article->title }}</a></td>
                           <td>{{ $article->category }}</td>
                           <td class="">{{ $article->views }}</td>
                           <td class="">@include('common.authorFormat', ['model'=>$article, 'field'=>'user'])</td>
                           <td data-order="{{ $article->created_at }}">{{ $article->created_at }}</td>
                           <td data-order="{{ $article->published_at }}">{{ $article->published_at }}</td>
                           <td>
                              <div class="float-right">
                                 <div class="btn-group">
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
