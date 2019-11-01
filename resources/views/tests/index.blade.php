@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="card mb-3">
      <!--CARD HEADER-->
      <div class="card-header section_header p-2">
         <i class="{{ Config::get('buttons.tests') }}"></i>
         Tests
         <span class="float-right">
            {{-- 
            @include('tests.buttons.add', ['model'=>'test'])
            --}}
            FAVORITES BUTTON
         </span>
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
                     <th class="no-sort"></th>
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
                        <td data-order="{{ $test->created_at}}">{{ $test->created_at ? $test->created_at->format('M d, Y') : 'no data found' }}</td>
                        <td class="text-right">
                           @include('tests.buttons.edit', ['size'=>'xs'])
                           @include('tests.buttons.delete', ['size'=>'xs'])
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
