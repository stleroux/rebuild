@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   {{-- @include('admin.categories.blocks.tree_list') --}}
@endsection

@section('content')

   <div class="row">
      <div class="col">
         <div class="card mb-3">
            <!--CARD HEADER-->
            <div class="card-header section_header p-2">
               <i class="fa fa-sitemap"></i>
               Categories
               <span class="float-right">
                  <div class="btn-group">
                     @include('admin.categories.buttons.help', ['size'=>'xs', 'bookmark'=>'categories'])
                     @include('admin.categories.buttons.add', ['size'=>'xs'])
                  </div>
               </span>
            </div>
            
            <!--CARD BODY-->               
            @if($categories->count() > 0)
               <div class="card-body section_body p-2">
                  <table id="datatable" class="table table-hover table-sm">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Category Name</th>
                           <th>Parent Category</th>
                           <th>Value</th>
                           <th>Created</th>
                           <th class="no-sort"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($categories as $category)
                           <tr>
                              <td>{{ $category->id }}</td>
                              <td>{{ ucfirst($category->name) }}</td>
                              <td>
                                 {{ $category->parent_id ? ucfirst($category->parent->name) : '' }} <small>(Parent:{{ $category->parent_id }})</small>
                              </td>
                              <td>{{ $category->value }}</td>
                              <td data-order="{{ $category->created_at}}">{{ $category->created_at }}</td>
                              <td class="text-right">
                                 <div class="btn-group">
                                    @include('admin.categories.buttons.show', ['size'=>'xs'])
                                    @include('admin.categories.buttons.edit', ['size'=>'xs'])
                                    @include('admin.categories.buttons.delete', ['size'=>'xs'])
                                 </div>
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
