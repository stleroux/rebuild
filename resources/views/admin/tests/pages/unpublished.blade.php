@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.tests.blocks.sidebar')
   @include('admin.tests.blocks.archives')
@endsection

@section('content')
   <form style="display:inline;">
      {!! csrf_field() !!}

      <div class="card">

         <div class="card-header section_header p-2">
            Unpublished Tests
            <span class="float-right">
               <div class="btn-group">
                  @include('admin.tests.buttons.help', ['size'=>'xs', 'bookmark'=>''])
                  @include('admin.tests.buttons.publishAll', ['size'=>'xs'])
                  @include('admin.tests.buttons.add', ['size'=>'xs'])
               </div>
            </span>
         </div>

         @if($tests->count())
            <div class="text-center">
               <div class="btn-group p-1">
                  <a href="{{ route('admin.tests.unpublished') }}" class="{{ Request::is('admin/tests/unpublished') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
                  @foreach($letters as $value)
                     <a href="{{ route('admin.tests.unpublished', $value) }}" class="{{ Request::is('admin/tests/unpublished/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
                  @endforeach
               </div>
            </div>
         @endif

         <div class="card-body section_body p-2">
            @if($tests->count())
               <table id="datatable" class="table table-hover table-sm searchHighlight">
                  <thead>
                     <tr>
                        <th><input type="checkbox" id="selectall" class="checked" /></th>
                        {{-- Add columns for search purposes only --}}
                        <th class="d-none">English</th>
                        <th class="d-none">French</th>
                        {{-- Add columns for search purposes only --}}

                        <th><div>Title</div></th>
                        <th class="hidden-xs">Category</th>
                        <th class="hidden-xs hidden-sm">Views</th>
                        <th class="hidden-xs">Author</th>
                        <th class="hidden-sm hidden-xs">Created On</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($tests as $key => $test)
                        <tr>
                           <td>
                              <input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$test->id}}" class="check-all">
                           </td>
                           {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
                           <td class="d-none">{{ $test->description_eng }}</td>
                           <td class="d-none">{{ $test->description_fre }}</td>
                           {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
                           
                           <td><a href="{{ route('admin.tests.show', $test->id) }}" class="">{{ $test->title }}</a></td>
                           <td class="hidden-xs">{{ $test->category }}</td>
                           <td class="hidden-xs hidden-sm">{{ $test->views }}</td>
                           <td class="hidden-xs">@include('common.authorFormat', ['model'=>$test, 'field'=>'user'])</td>
                           <td class="hidden-sm hidden-xs">@include('common.dateFormat', ['model'=>$test, 'field'=>'created_at'])</td>
                           <td>
                              @include('admin.tests.buttons.edit', ['size'=>'xs'])
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
