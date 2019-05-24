@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
   @include('blocks.main_menu')
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
                  <i class="fa fa-download"></i>
                  Unpublished Posts
                     
                  <div class="float-right">
                     @if(checkPerm('post_create'))
                        <button
                           class="btn btn-sm btn-danger px-1 py-0"
                           type="submit"
                           formaction="{{ route('posts.trashAll') }}"
                           formmethod="POST"
                           id="bulk-delete"
                           style="display:none; margin-left:2px"
                           onclick="return confirm('Are you sure you want to trash these posts?')">
                           <i class="far fa-trash-alt"></i>
                           Trash Selected
                        </button>
                                          
                        <button
                           class = "btn btn-sm btn-secondary px-1 py-0"
                           type="submit"
                           formaction="{{ route('posts.publishAll') }}"
                           formmethod="POST"
                           id="bulk-publish"
                           style="display:none; margin-left:2px"
                           onclick="return confirm('Are you sure you want to publish these posts?')">
                           <i class="fa fa-download"></i>
                           Publish Selected
                        </button>

                        @include('posts.buttons.add')
                     @endif
                  </div>
               </div>

               
               @if($posts->count() > 0)
                  <div class="card-body card_body p-2">
                     @include('common.alphabet', ['model'=>'post', 'page'=>'unpublished'])
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
                                 {{-- <a href="{{ route('posts.publish', $post->id) }}" class="btn btn-sm btn-outline-secondary px-1 py-0" title="Publish Post">
                                    <i class="fa fa-upload"></i>
                                 </a> --}}
                                 @include('posts.buttons.show')
                                 @include('posts.buttons.publish')

                                 {{-- <a href="{{ route('posts.unpublish', $post->id) }}" class="btn btn-sm btn-outline-secondary px-1 py-0" title="Unpublish Post">
                                    <i class="fa fa-download"></i>
                                 </a> --}}

                                 {{-- <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-secondary px-1 py-0" title="View Post">
                                    <i class="fa fa-eye"></i>
                                 </a> --}}


                                 @if(checkPerm('post_edit', $post))
                                    {{-- <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-bprimary px-1 py-0" title="Edit Post">
                                       <i class="far fa-edit"></i>
                                    </a> --}}
                                    @include('posts.buttons.edit')
                                 @endif
                                 @if(checkPerm('post_delete', $post))
                                    {{-- <a href="{{ route('posts.trash', $post->id) }}" class="btn btn-sm btn-outline-danger px-1 py-0" title="Trash Post">
                                       <i class="far fa-trash-alt"></i>
                                    </a> --}}
                                    @include('posts.buttons.trash')
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
                                 $("#bulk-publish").show();
                                 $(".selectmenu").hide();

                           } else {
                                 $("input[type=checkbox]").each(function () {
                                        $(this).attr("checked", false);
                                 });
                                 $("#bulk-delete").hide();
                                 $("#bulk-publish").hide();
                                 $(".selectmenu").show();
                           }
                   });
             });

             function checkbox_is_checked() {

                   if ($(".check-all:checked").length > 0)
                   {
                           $("#bulk-delete").show();
                           $("#bulk-publish").show();
                           $(".selectmenu").hide();
                   }
                   else
                   {
                           $("#bulk-delete").hide();
                           $("#bulk-publish").hide();
                           $(".selectmenu").show();
                   }
             };

      </script>

@stop