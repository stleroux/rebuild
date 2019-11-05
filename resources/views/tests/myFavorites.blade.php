@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('tests.blocks.popular')
   @include('tests.blocks.archives')
@endsection

@section('content')

   <form style="display:inline;">
      {!! csrf_field() !!}

         <div class="card mb-3">
            <div class="card-header section_header p-2">
               <i class="{{ Config::get('buttons.tests') }}"></i>
               My Favorite Tests
               <span class="float-right">
                  <div class="btn-group">
                     @include('tests.buttons.back', ['size'=>'xs', 'btn_label'=>'Back'])
                  </div>
               </span>
            </div>
         
            <div class="card-body section_body p-2">
               @if($tests->count())
                  <table id="datatable" class="table table-hover table-sm searchHighlight">
                     <thead>
                        <tr>
                           {{-- Add columns for search purposes only --}}
                           <th class="d-none">English</th>
                           <th class="d-none">French</th>
                           {{-- Add columns for search purposes only --}}

                           <th class="">Name</th>
                           <th class="">Views</th>
                           <th class="">Status</th>
                           <th class="">Author</th>
                           <th class="">Created On</th>
                           <th class="">Publish(ed) On</th>
                           <th class="" data-orderable="false"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($tests as $key => $test)
                           <tr>
                              {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
                              <td class="d-none">{{ $test->description_eng }}</td>
                              <td class="d-none">{{ $test->description_fre }}</td>
                              {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
                              
                              <td><a href="{{ route('tests.show', $test->id) }}" class="">{{ $test->name }}</a></td>
                              <td class="">{{ $test->category }}</td>
                              <td class="">{{ $test->views }}</td>
                              <td class="">@include('common.authorFormat', ['model'=>$test, 'field'=>'user'])</td>
                              <td class="">@include('common.dateFormat', ['model'=>$test, 'field'=>'created_at'])</td>
                              <td class=" 
                                 {{ $test->published_at >= Carbon\Carbon::now() ? 'text text-warning' : '' }}
                                 {{ $test->published_at == null ? 'text text-info' : '' }}">
                                 @include('common.dateFormat', ['model'=>$test, 'field'=>'published_at'])
                              </td>
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
   </form>
      
@endsection
