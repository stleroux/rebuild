@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.posts.sidebar')
@endsection

@section('content')

   <form style="display:inline;">
      {!! csrf_field() !!}

      <div class="card mb-2">
         <div class="card-header section_header p-2">
            <i class="{{ Config::get('buttons.published') }}"></i>
            Published Posts
            <div class="float-right">
               <div class="btn-group">
                  @include('admin.posts.buttons.unpublishAll', ['size'=>'xs'])
                  @include('admin.posts.buttons.trashAll', ['size'=>'xs'])
                  @include('admin.posts.buttons.help', ['size'=>'xs', 'bookmark'=>'posts'])
                  @include('admin.posts.buttons.add', ['size'=>'xs'])
               </div>
            </div>
         </div>

         <div class="card-body section_body p-2">
            @if($posts->count() > 0)
               @include('admin.posts.alphabet', ['model'=>'post', 'page'=>'index'])
               <table id="datatable" class="table table-hover table-sm">
                  <thead>
                     <tr>
                        <th data-orderable="false"><input type="checkbox" id="selectall" class="checked" /></th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Views</th>
                        <th>Created By</th>
                        <th>Created On</th>
                        <th>Published</th>
                        {{-- <th>Slug</th> --}}
                        {{-- <th>Category</th> --}}
                        {{-- <th>Views</th> --}}
                        {{-- @if(checkACL('author')) --}}
                        <th data-orderable="false"></th>
                        {{-- @endif --}}
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($posts as $post)
                        <tr>
                           <td data-orderable="false">
                              @if(checkPerm('post_delete', $post))
                                 <input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{ $post->id }}" class="check-all">
                              @endif
                           </td>
                           <td>{{ $post->id }}</td>
                           <td><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></td>
                           <td>{{ ucwords($post->category->name) }}</td>
                           <td>{{ $post->views }}</td>
                           <td>@include('common.authorFormat', ['model'=>$post, 'field'=>'user'])</td>
                           <td>@include('common.dateFormat', ['model'=>$post, 'field'=>'created_at'])</td>
                           <td>
                              @include('common.dateFormat', ['model'=>$post, 'field'=>'published_at'])
                           </td>
                           <td class="text-right">
                              <div class="btn-group">
                                 @include('admin.posts.buttons.publish', ['size'=>'xs'])
                                 @include('admin.posts.buttons.show', ['size'=>'xs'])
                                 @include('admin.posts.buttons.edit', ['size'=>'xs'])
                                 @include('admin.posts.buttons.trash', ['size'=>'xs'])
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

@section('scripts')
   @include('scripts.bulkButtons')
@endsection
