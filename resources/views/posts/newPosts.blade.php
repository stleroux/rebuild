@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('posts.sidebar')
   @include('blog.blocks.popularPosts')
   @include('blog.blocks.archives')
@endsection

@section('content')

   <form style="display:inline;">
      {!! csrf_field() !!}
      
      <div class="row">
         <div class="col">
            <div class="card mb-2">
               <div class="card-header card_header p-2">
                  <i class="{{ Config::get('buttons.new') }}"></i>
                  New Posts
                  <div class="float-right">
                     @include('posts.buttons.trashAll', ['size'=>'xs'])
                     @include('posts.buttons.publishAll', ['size'=>'xs'])
                     {{-- @include('posts.buttons.published', ['size'=>'xs']) --}}
                     {{-- @include('posts.buttons.unpublished', ['size'=>'xs']) --}}
                     {{-- @include('posts.buttons.newPosts', ['size'=>'xs']) --}}
                     {{-- @include('posts.buttons.trashed', ['size'=>'xs']) --}}
                     {{-- @include('posts.buttons.back', ['size'=>'xs']) --}}
                     @include('posts.buttons.add', ['size'=>'xs'])
                  </div>
               </div>

               <div class="card-body card_body p-2">
                  @if($posts->count() > 0)
                     {{-- @include('common.alphabet', ['model'=>'post', 'page'=>'newPosts']) --}}
                     <table id="datatable" class="table table-hover table-sm">
                        <thead>
                           <tr>
                              <th><input type="checkbox" id="selectall" class="checked" /></th>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Category</th>
                              {{-- <th>Views</th> --}}
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
                              {{-- <td>{{ $post->views }}</td> --}}
                              <td>{{ ucfirst($post->user->username) }}</td>
                              <td>{{ $post->created_at->format('M d, Y') }}</td>                            
                              {{-- @if(checkACL('author')) --}}
                              <td class="text-right">
                                 @include('posts.buttons.show', ['size'=>'xs'])
                                 @include('posts.buttons.publish', ['size'=>'xs'])
                                 @if(checkPerm('post_edit', $post))
                                    @include('posts.buttons.edit', ['size'=>'xs'])
                                 @endif
                                 @if(checkPerm('post_delete', $post))
                                    @include('posts.buttons.trash', ['size'=>'xs'])
                                 @endif
                              </td>
                              {{-- @endif --}}
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  @else
                     {{ setting('no_records_found') }}
                  @endif
               </div>
            </div>
         </div>
      </div>
   </form>

@endsection

@section('scripts')

   <script>
      $(function () {
         $("#selectall").click(function () {
            if ($("#selectall").is(':checked')) {
               $("input[type=checkbox]").each(function () {
                  $(this).attr("checked", true);
               });
               $("#bulk-trash").show();
               $("#bulk-publish").show();
               $(".selectmenu").hide();
            } else {
               $("input[type=checkbox]").each(function () {
                  $(this).attr("checked", false);
               });
               $("#bulk-trash").hide();
               $("#bulk-publish").hide();
               $(".selectmenu").show();
            }
         });
      });

      function checkbox_is_checked() {
         if ($(".check-all:checked").length > 0) {
            $("#bulk-trash").show();
            $("#bulk-publish").show();
            $(".selectmenu").hide();
         } else {
            $("#bulk-trash").hide();
            $("#bulk-publish").hide();
            $(".selectmenu").show();
         }
      };

   </script>

@endsection
