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
      
      <!--CARD HEADER-->
      <div class="card-header section_header p-2">
         <i class="{{ Config::get('buttons.tests') }}"></i>
         Tests
         <div class="float-right">
            <div class="btn-group">
               @include('admin.tests.buttons.help', ['size'=>'xs', 'bookmark'=>'tests'])
               @include('admin.tests.buttons.add', ['size'=>'xs', 'model'=>'test'])
            </div>
         </div>
      </div>

<!-- ALPHABET -->
<div class="text-center">
   <div class="btn-group p-1">
      <a href="{{ route('admin.tests.index') }}" class="{{ Request::is('admin/tests') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
      @foreach($letters as $value)
         <a href="{{ route('admin.tests.index', $value) }}" class="{{ Request::is('admin/tests/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
      @endforeach
   </div>
</div>


      <!--CARD BODY-->
      <div class="card-body section_body p-2">

         @if($tests->count() > 0)
            <table id="datatable" class="table table-hover table-sm">
               <thead>
                  <tr>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Status</th>
                     <!-- Add columns below for search purposes only -->
                     <!-- Add columns above for search purposes only -->
                     <th>Created</th>
                     <th class="">Publish(ed) On</th>
                     <th data-orderable="false"></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($tests as $test)
                     <tr>
                        <td><a href="{{ route('admin.tests.show', $test->id) }}">{{ $test->name }}</a></td>
                        <td>{{ $test->email }}</td>
                        <td>{{ $test->status }}</td>
                        <!-- Add columns below for search purposes only -->
                        <!-- Add columns above for search purposes only -->
                        <td data-order="{{$test->created_at}}">{{$test->created_at}}</td>
                        <td class="{{ $test->published_at >= Carbon\Carbon::now() ? 'font-italic text text-info' : '' }}">
                           @include('common.dateFormat', ['model'=>$test, 'field'=>'published_at'])
                        </td>
                        <td>
                           <div class="float-right">
                              <div class="btn-group">
                                 @include('admin.tests.buttons.publish', ['size'=>'xs'])
                                 @include('admin.tests.buttons.edit', ['size'=>'xs'])
                                 @include('admin.tests.buttons.delete', ['size'=>'xs'])
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
