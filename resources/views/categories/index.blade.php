@extends('layouts.master')

@section('stylesheets')
   {{-- {{ Html::style('css/woodbarn.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')

   {{-- <form style="display:inline;"> --}}
      {{-- {!! csrf_field() !!} --}}
      <div class="row">
         <div class="col">
            <div class="card mb-3">
               <!--CARD HEADER-->
               <div class="card-header section_header p-2">
                  <i class="fa fa-sitemap"></i>
                  Categories
                  <span class="float-right">
                     @include('categories.buttons.help', ['size'=>'xs', 'bookmark'=>'categories'])
                     {{-- @include('help.categories.index') --}}
                     {{-- @include('help.index') --}}
                     @include('categories.buttons.add', ['size'=>'xs'])
                  </span>
               </div>
               
               <!--CARD BODY-->
               
               @if($categories->count() > 0)
                  <div class="card-body section_body p-2">
                     {{-- @include('common.alphabet', ['model'=>'category', 'page'=>'index']) --}}
                     <table id="datatable" class="table table-hover table-sm">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Category Name</th>
                              {{-- <th>Module</th> --}}
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
                                 {{-- <td>{{ $category->module->name }}</td> --}}
                                 {{-- <td>{{ $category->parent->name or 'Null' }}</td> --}}
                                 <td>{{ $category->parent_id ? ucfirst($category->parent->name) : '' }} <small>(Parent:{{ $category->parent_id }})</small></td>
                                 <td>{{ $category->value }}</td>
                                 <td data-order="{{ $category->created_at}}">{{ $category->created_at ? $category->created_at->format('M d, Y') : 'no data found' }}</td>
                                 <td class="text-right">
                                       @include('categories.buttons.show', ['size'=>'xs'])
                                    {{-- @if(checkPerm('category_edit')) --}}
                                       @include('categories.buttons.edit', ['size'=>'xs'])
                                    {{-- @endif --}}

                                    {{-- @if(checkPerm('category_delete')) --}}
                                       @include('categories.buttons.delete', ['size'=>'xs'])
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
   {{-- </form> --}}

@endsection
