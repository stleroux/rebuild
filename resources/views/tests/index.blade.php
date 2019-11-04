@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('tests.blocks.archives')
@endsection

@section('content')

   <div class="card mb-3">
      <!--CARD HEADER-->
      <div class="card-header section_header p-2">
         <i class="{{ Config::get('buttons.tests') }}"></i>
         Tests
         <div class="float-right">
            @include('tests.buttons.myFavorites', ['size'=>'xs', 'btn_label'=>'My Favorites'])
         </div>
      </div>

      <!--CARD BODY-->
      <div class="card-body section_body p-2">
         @if($tests->count() > 0)
            {{-- @include('common.alphabet', ['model'=>'test', 'page'=>'index']) --}}
            <table id="datatable" class="table table-hover table-sm">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Status</th>
                     {{-- Add more columns here --}}
                     <th>Created</th>
                     <th data-orderable="false"></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($tests as $test)
                     <tr>
                        <td>{{ $test->id }}</td>
                        <td><a href="{{ route('tests.show', $test->id) }}">{{ $test->name }}</a></td>
                        <td>{{ $test->email }}</td>
                        <td>{{ $test->status }}</td>
                        {{-- Add more columns here --}}
                        <td data-order="{{ $test->created_at}}">{{ $test->created_at }}</td>
                        <td>
                           <div class="float-right">
                              <div class="btn-group">
                                 @include('tests.buttons.favorite', ['size'=>'xs'])
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

@endsection
