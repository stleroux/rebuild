@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('css/posts.css') }}
@stop

@section('left_column')
   @include('blocks.adminNav')
   @include('posts.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   <form style="display:inline;">
      {!! csrf_field() !!}
      
      <div class="row">
         <div class="col">
            <div class="card">
               <div class="card-header card_header">
                  <i class="far fa-trash-alt"></i>
                  Trashed Posts
                  <div class="float-right">
                     @if(checkPerm('post_create'))
                        <button
                           class="btn btn-sm btn-outline-danger px-1 py-0"
                           type="submit"
                           formaction="{{ route('posts.deleteAll') }}"
                           formmethod="POST"
                           id="bulk-delete"
                           style="display:none; margin-left:2px"
                           onclick="return confirm('Are you sure you want to trash these posts?')">
                           <i class="far fa-trash-alt"></i>
                           Delete Selected
                        </button>
                                          
                        <button
                           class = "btn btn-sm btn-outline-secondary px-1 py-0"
                           type="submit"
                           formaction="{{ route('posts.restoreAll') }}"
                           formmethod="POST"
                           id="bulk-restore"
                           style="display:none; margin-left:2px"
                           onclick="return confirm('Are you sure you want to restore these posts?')">
                           <i class="fa fa-download"></i>
                           Restore Selected
                        </button>
                     @endif
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
                                 @include('common.buttons.show', ['model'=>'post', 'id'=>$post->id])
                                 @include('common.buttons.restore', ['model'=>'post', 'id'=>$post->id])
                                 @if(checkPerm('post_delete', $post))
                                    @include('common.buttons.delete', ['model'=>'post', 'id'=>$post->id])
                                 @endif

                              </td>
                              {{-- @endif --}}
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               @else
                  <div class="card-body">
                     {{ setting('no_records_found') }}
                  </div>
               @endif
            </div>
         </div>
      </div>
   </form>

@stop

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

@stop