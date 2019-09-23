@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
   {{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
   @include('admin.posts.sidebar')
   @include('blog.blocks.popularPosts')
   @include('blog.blocks.archives')
@endsection

@section('content')

   <form style="display:inline;">
      {!! csrf_field() !!}
      
      <div class="row">
         <div class="col">
            <div class="card mb-2">
               <div class="card-header section_header p-2">
                  <i class="{{ Config::get('buttons.unpublished') }}"></i>
                  Unpublished Posts
                  <div class="float-right">
                     <div class="btn-group">
                        @include('admin.posts.buttons.trashAll', ['size'=>'xs'])
                        @include('admin.posts.buttons.publishAll', ['size'=>'xs'])
                        @include('admin.posts.buttons.add', ['size'=>'xs'])
                     </div>
                  </div>
               </div>

               
               @if($posts->count() > 0)
                  <div class="card-body section_body p-2">
                     @include('admin.posts.alphabet', ['model'=>'post', 'page'=>'unpublished'])
                     <table id="datatable" class="table table-hover table-sm">
                        <thead>
                           <tr>
                              <th><input type="checkbox" id="selectall" class="checked" /></th>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Category</th>
                              <th>Views</th>
                              <th>Created By</th>
                              <th>Created On</th>                              
                              {{-- @if(checkACL('author')) --}}
                              <th data-orderable="false"></th>
                              {{-- @endif --}}
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($posts as $post)
                           <tr>
                              <td>
                                 <input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{ $post->id }}" class="check-all">
                              </td>
                              <td>{{ $post->id }}</td>
                              <td>{{ $post->title }}</td>
                              <td>{{ $post->category->name }}</td>
                              <td>{{ $post->views }}</td>
                              <td>{{ ucfirst($post->user->username) }}</td>
                              <td>{{ $post->created_at->format('M d, Y') }}</td>                              
                              {{-- @if(checkACL('author')) --}}
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
                  </div>
               @else
                  <div class="card-body p-2">
                     {{ setting('no_records_found') }}
                  </div>
               @endif
            </div>
         </div>
      </div>
   </form>

@endsection

@section('scripts')
   @include('scripts.bulkButtons')
@endsection