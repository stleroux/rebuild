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
            <div class="card mb-3">
               <div class="card-header card_header p-2">
                  <i class="far fa-trash-alt"></i>
                  Trashed Posts
                  <div class="float-right">
                     @include('posts.buttons.deleteAll', ['size'=>'xs'])
                     @include('posts.buttons.add', ['size'=>'xs'])
                  </div>
               </div>

               @if($posts->count() > 0)
                  <div class="card-body card_body p-2">
                     @include('common.alphabet', ['model'=>'post', 'page'=>'trashed'])
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
                              <th>Publish(ed) On</th>
                              <th>Trashed On</th>
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
                              <td>{{ ($post->published) ? $post->published_at->format('M d, Y') : 'no data found' }}</td>
                              <td>{{ $post->deleted_at->format('M d, Y') }}</td>
                              {{-- @if(checkACL('author')) --}}
                              <td class="text-right">
                                 @include('posts.buttons.show', ['size'=>'xs', 'id'=>$post->id])
                                 {{-- @include('posts.buttons.restore', ['size'=>'xs', 'id'=>$post->id]) --}}
                                 @if(checkPerm('post_delete', $post))
                                    {{-- @include('posts.buttons.delete', ['size'=>'xs', 'id'=>$post->id]) --}}
                                 @endif

                              </td>
                              {{-- @endif --}}
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
      <script>

             $(function () {
                   $("#selectall").click(function () {
                           if ($("#selectall").is(':checked')) {
                                 $("input[type=checkbox]").each(function () {
                                        $(this).attr("checked", true);
                                 });
                                 $("#bulk-delete").show();
                                 $("#bulk-restore").show();
                                 $(".selectmenu").hide();

                           } else {
                                 $("input[type=checkbox]").each(function () {
                                        $(this).attr("checked", false);
                                 });
                                 $("#bulk-delete").hide();
                                 $("#bulk-restore").hide();
                                 $(".selectmenu").show();
                           }
                   });
             });

             function checkbox_is_checked() {

                   if ($(".check-all:checked").length > 0)
                   {
                           $("#bulk-delete").show();
                           $("#bulk-restore").show();
                           $(".selectmenu").hide();
                   }
                   else
                   {
                           $("#bulk-delete").hide();
                           $("#bulk-restore").hide();
                           $(".selectmenu").show();
                   }
             };

      </script>

@endsection