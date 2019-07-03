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
               Finishes
               <span class="float-right">
                  <a href="{{ route('projects.index') }}" class="btn btn-xs btn-primary">Projects</a>
                  <a href="{{ route('materials.index') }}" class="btn btn-xs btn-primary">Materials</a>
                  {{-- @include('projects.addins.links.help', ['bookmark'=>'projects']) --}}
                  {{-- @include('projects.addins.links.add', ['model'=>'project']) --}}
               </span>
            </div>

            <!--CARD BODY-->
            @if($finishes->count() > 0)
               <div class="card-body card_body pb-0">
                  {{-- @include('common.alphabet', ['model'=>'woodproject', 'page'=>'index']) --}}
                  <table id="datatable" class="table table-hover table-sm">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Category</th>
                           <th>Description</th>
                           <th>Created On</th>
                           <th>Updated On</th>
                           <th class="no-sort"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($finishes as $finish)
                           <tr>
                              <td>{{ $finish->id }}</td>
                              <td><a href="{{ route('finishes.show', $finish->id) }}">{{ $finish->name }}</a></td>
                              <td>{{ $finish->category }}</td>
                              <td>{{ $finish->description }}</td>
                              {{-- Add more columns here --}}
                              <td data-order="{{ $finish->created_at}}">{{ $finish->created_at ? $finish->created_at->format('M d, Y') : 'no data found' }}</td>
                              <td data-order="{{ $finish->updated_at}}">{{ $finish->updated_at ? $finish->updated_at->format('M d, Y') : 'no data found' }}</td>
                              <td class="text-right">
                                 @if(checkPerm('projects_edit'))
                                    {{-- @include('finishes.addins.links.edit', ['size'=>'xs']) --}}
                                 @endif

                                 @if(checkPerm('projects_delete'))
                                    {{-- @include('finishes.addins.links.delete', ['size'=>'xs']) --}}
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
