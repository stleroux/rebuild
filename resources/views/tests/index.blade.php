@extends('layouts.')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   {{-- @include('blocks.adminNav') --}}
   {{-- @include('tests.sidebar') --}}
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="row">
      <div class="col">
         <div class="card mb-2">
            <!--CARD HEADER-->
            <div class="card-header card_header">
               {{-- <i class="fa fa-sitemap"></i> --}}
               Tests
               <span class="float-right">
                  @include('common.buttons.help', ['bookmark'=>'tests'])
                  @include('common.buttons.add', ['model'=>'test'])
               </span>
            </div>

            <!--CARD BODY-->
            @if($tests->count() > 0)
               <div class="card-body card_body pb-0">
                  @include('common.alphabet', ['model'=>'test', 'page'=>'index'])
                  <table id="datatable" class="table table-hover table-sm">
                     <thead>
                        <tr>
                           <th>ID</th>
                           {{-- Add more columns here --}}
                           <th>Created</th>
                           <th class="no-sort"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($tests as $test)
                           <tr>
                              <td>{{ $test->id }}</td>
                              {{-- Add more columns here --}}
                              <td data-order="{{ $test->created_at}}">{{ $test->created_at ? $test->created_at->format('M d, Y') : 'no data found' }}</td>
                              <td class="text-right">
                                 @if(checkPerm('test_edit'))
                                    @include('common.buttons.edit', ['model'=>'test', 'id'=>$test->id])
                                 @endif

                                 @if(checkPerm('test_delete'))
                                    @include('common.buttons.delete', ['model'=>'test', 'id'=>$test->id])
                                 @endif
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            @else
               <div class="card-body card_body">
                  {{ setting('no_records_found') }}
               </div>
            @endif
            
         </div>
      </div>
   </div>

@endsection
