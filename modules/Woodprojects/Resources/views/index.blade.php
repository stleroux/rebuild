@extends('layouts.master')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   {{-- @include('blocks.adminNav') --}}
   {{-- @include('woodprojects.sidebar') --}}
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
               Woodprojects
               <span class="float-right">
                  @include('common.buttons.help', ['bookmark'=>'woodprojects'])
                  @include('common.buttons.add', ['model'=>'woodproject'])
               </span>
            </div>

            <!--CARD BODY-->
            @if($woodprojects->count() > 0)
               <div class="card-body card_body pb-0">
                  {{-- @include('common.alphabet', ['model'=>'woodproject', 'page'=>'index']) --}}
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
                        @foreach ($woodprojects as $woodproject)
                           <tr>
                              <td>{{ $woodproject->id }}</td>
                              <td><a href="{{ route('woodprojects.show', $woodproject->id) }}">{{ $woodproject->name }}</a></td>
                              <td>{{ $woodproject->email }}</td>
                              <td>{{ $woodproject->status }}</td>
                              {{-- Add more columns here --}}
                              <td data-order="{{ $woodproject->created_at}}">{{ $woodproject->created_at ? $woodproject->created_at->format('M d, Y') : 'no data found' }}</td>
                              <td class="text-right">
                                 {{-- @if(checkPerm('woodproject_edit')) --}}
                                    @include('common.buttons.edit', ['model'=>'woodproject', 'id'=>$woodproject->id])
                                 {{-- @endif --}}

                                 {{-- @if(checkPerm('woodproject_delete')) --}}
                                    @include('common.buttons.delete', ['model'=>'woodproject', 'id'=>$woodproject->id])
                                 {{-- @endif --}}
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
