@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')
   <form style="display:inline;">
   {{-- <form method="POST" action="{{ route('backend.recipes.trashAll') }}"> --}}
      {!! csrf_field() !!}
         
      <div class="card mb-3">
         <div class="card-header section_header p-2">
            <i class="fas fa-comments"></i>
            Comments
            {{-- <button
               class="btn btn-xs btn-danger pull-right"
               type="submit"
               formaction="{{ route('backend.recipes.trashAll') }}"
               formmethod="POST"
               id="bulk-delete"
               style="display:none; margin-left:2px"
               onclick="return confirm('Are you sure you want to trash these recipes?')">
               Trash Selected
            </button> --}}
            {{-- <button
               class = "btn btn-xs btn-default pull-right"
               type="submit"
               formaction="{{ route('backend.recipes.unpublishAll') }}"
               formmethod="POST"
               id="bulk-unpublish"
               style="display:none; margin-left:2px"
               onclick="return confirm('Are you sure you want to unpublish these recipes?')">
               Unpublish Selected
            </button> --}}
         </div>

         <div class="card-body section_body p-2">
            @if($comments->count() > 0)
               <table id="datatable" class="table table-hover table-sm">
                  <thead>
                     <tr>
                        <th><input type="checkbox" id="selectall" class="checked" /></th>
                        <th>Comment</th>
                        <th>Name / Username</th>
                        <th>Email</th>
                        <th>Item Type</th>
                        <th>Item ID</th>
                        {{-- @if(checkACL('author')) --}}
                            <th data-orderable="false"></th>
                        {{-- @endif --}}
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($comments as $comment)
                        <tr>
                           <td>
                              <input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{ $comment->id }}" class="check-all">
                           </td>
                           <td>{{ $comment->comment }}</td>
                           <td>{{ $comment->user->username }}</td>
                           <td>{{ $comment->user->email }}</td>
                           <td>{{ $comment->commentable_type }}</td>
                           <td>{{ $comment->commentable_id }}</td>
                           <td class="text-right">
                              <div class="btn-group">
                                 @include('comments.buttons.edit', ['size'=>'xs'])
                                 @include('comments.buttons.delete', ['size'=>'xs'])
                              </div>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            @else
               NO RECORDS FOUND
            @endif
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
               $("#bulk-unpublish").show();
               $(".selectmenu").hide();
            } else {
               $("input[type=checkbox]").each(function () {
                  $(this).attr("checked", false);
               });
      
               $("#bulk-delete").hide();
               $("#bulk-unpublish").hide();
               $(".selectmenu").show();
            }
         });
      });

   function checkbox_is_checked() {
      if ($(".check-all:checked").length > 0) {
         $("#bulk-delete").show();
         $("#bulk-unpublish").show();
         $(".selectmenu").hide();
      } else {
         $("#bulk-delete").hide();
         $("#bulk-unpublish").hide();
         $(".selectmenu").show();
      }
   };
</script>

@endsection