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
      
      <div class="card mb-3">

         <div class="card-header section_header p-2">
            My Tests
            <span class="float-right">
               <div class="btn-group">
                  @include('admin.tests.buttons.help', ['size'=>'xs', 'bookmark'=>''])
                  @include('admin.tests.buttons.unpublishAll', ['size'=>'xs'])
                  @include('admin.tests.buttons.trashAll', ['size'=>'sm'])
                  @include('admin.tests.buttons.add', ['size'=>'xs'])
               </div>
            </span>
         </div>

         @if($tests->count())
            <div class="text-center">
               <div class="btn-group p-1">
                  <a href="{{ route('admin.tests.myTests') }}" class="{{ Request::is('admin/tests/myTests') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
                  @foreach($letters as $value)
                     <a href="{{ route('admin.tests.myTests', $value) }}" class="{{ Request::is('admin/tests/myTests/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
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
                           {{-- <th class="d-none">English</th> --}}
                           {{-- <th class="d-none">French</th> --}}
                        {{-- Add columns for search purposes only --}}
                        <th>Name</th>
                        <th>Email</th>
                        <th class="">Status</th>
                        <th class="">Views</th>
                        <th class="">Author</th>
                        <th class="">Created On</th>
                        <th class="">Publish(ed) On</th>
                        <th data-orderable="false"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($tests as $key => $test)
                        <tr>
                           <td>
                              <input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$test->id}}" class="check-all">
                           </td>
                           {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
                              {{-- <td class="d-none">{{ $test->description_eng }}</td> --}}
                              {{-- <td class="d-none">{{ $test->description_fre }}</td> --}}
                           {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
                           <td><a href="{{ route('admin.tests.show', $test->id) }}" class="">{{ $test->name }}</a></td>
                           <td>{{ $test->email }}</td>
                           <td>{{ $test->status }}</td>
                           <td class="">{{ $test->views }}</td>
                           <td class="">@include('common.authorFormat', ['model'=>$test, 'field'=>'user'])</td>
                           <td class="">@include('common.dateFormat', ['model'=>$test, 'field'=>'created_at'])</td>
                           <td class=" 
                              {{ $test->published_at >= Carbon\Carbon::now() ? 'text text-warning' : '' }}
                              {{ $test->published_at == null ? 'text text-info' : '' }}
                           ">
                              @include('common.dateFormat', ['model'=>$test, 'field'=>'published_at'])
                           </td>
                           <td>
                              <div class="float-right">
                                 <div class="btn-group">
                                    @include('admin.tests.buttons.publish', ['size'=>'xs'])
                                    @include('admin.tests.buttons.edit', ['size'=>'xs'])
                                    @include('admin.tests.buttons.trash', ['size'=>'xs'])
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
