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
      
      <div class="row">
         <div class="col">
            <div class="card mb-2">
               <div class="card-header section_header p-2">
                  {{-- <i class="{{ Config::get('buttons.new') }}"></i> --}}
                  <i class="{{ Config::get('buttons.future') }}"></i>
                  Future Posts
                  <div class="float-right">
                     <div class="btn-group">
                        @include('admin.posts.buttons.trashAll', ['size'=>'xs'])
                        @include('admin.posts.buttons.publishAll', ['size'=>'xs'])
                        @include('admin.posts.buttons.add', ['size'=>'xs'])
                     </div>
                  </div>
               </div>

               <div class="card-body section_body p-2">
                  @if($posts->count() > 0)
                     @include('admin.posts.alphabet', ['model'=>'post', 'page'=>'newPosts'])
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
                              <td><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></td>
                              <td>{{ $post->category->name }}</td>
                              {{-- <td>{{ $post->views }}</td> --}}
                              <td>{{ ucfirst($post->user->username) }}</td>
                              <td>{{ $post->created_at }}</td>                            
                              {{-- @if(checkACL('author')) --}}
                              <td class="text-right">
                                 <div class="btn-group">
                                    @include('admin.posts.buttons.publish', ['size'=>'xs'])
                                    @include('admin.posts.buttons.show', ['size'=>'xs'])
                                    @include('admin.posts.buttons.edit', ['size'=>'xs'])
                                    @include('admin.posts.buttons.trash', ['size'=>'xs'])
                                 </div>
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
