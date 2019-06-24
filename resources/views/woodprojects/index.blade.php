@extends('layouts.backend')

@section('stylesheets')
   {{-- {{ Html::style('css/.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.main_menu')
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
                  @include('woodprojects.addins.links.help', ['bookmark'=>'woodprojects'])
                  @include('woodprojects.addins.links.add', ['model'=>'woodproject'])
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
                                    @include('woodprojects.addins.links.edit', ['size'=>'xs'])
                                 {{-- @endif --}}

                                 {{-- @if(checkPerm('woodproject_delete')) --}}
                                    @include('woodprojects.addins.links.delete', ['size'=>'xs'])
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
