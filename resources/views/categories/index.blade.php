@extends('layouts.backend')

@section('left_column')
   @include('blocks.adminNav')
   @include('categories.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   <form style="display:inline;">
      {{-- {!! csrf_field() !!} --}}
      <div class="row">
         <div class="col">
            <div class="card mb-2">
               <!--CARD HEADER-->
               <div class="card-header card_header">
                  <i class="fa fa-sitemap"></i>
                  Categories
                  <span class="float-right">
                     @include('common.buttons.help', ['model'=>'category', 'type'=>''])
                     @include('help.categories.index')
                     @include('common.buttons.add', ['model'=>'category', 'type'=>''])
                  </span>
               </div>
               
               <!--CARD BODY-->
               <div class="card-body card_body pb-0">
                  @include('common.alphabet', ['model'=>'category', 'page'=>'index'])
                  <table id="datatable" class="table table-hover table-sm">
                     <thead>
                        <tr>
                           <th>Name</th>
                           <th>Module</th>
                           <th>Value</th>
                           <th>Created</th>
                           <th class="no-sort"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($categories as $category)
                           <tr>
                              <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></td>
                              <td>{{ $category->module->name }}</td>
                              <td>{{ $category->value }}</td>
                              <td data-order="{{ $category->created_at}}">{{ $category->created_at->format('M d, Y') }}</td>
                              <td class="text-right">
                                 @if(checkPerm('category_edit'))
                                    @include('common.buttons.edit', ['model'=>'category', 'id'=>$category->id, 'type'=>''])
                                 @endif

                                 @if(checkPerm('category_delete'))
                                    @include('common.buttons.delete', ['model'=>'category', 'id'=>$category->id, 'type'=>''])
                                 @endif
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div> {{-- End of card-body --}}
            </div>
         </div>
      </div>
   </form>

@endsection
