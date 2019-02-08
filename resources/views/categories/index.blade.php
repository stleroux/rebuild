@extends('layouts.master')

@section('left_column')
   @include('blocks.admin_menu')
@endsection

@section('right_column')
	@include('help.categories.index')
@endsection

@section('content')

   <div class="row">
      <div class="col">
         <div class="card mb-2">
            <!--CARD HEADER-->
            <div class="card-header card_header">
               <i class="fa fa-sitemap"></i>
               Categories
               <span class="float-right">
                  @if(checkPerm('user_create'))
                     <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-success px-1 py-0">
                        <i class="fas fa-plus-square"></i>
                        New Category
                     </a>
                  @endif
                  <button type="button" class="btn btn-sm btn-outline-secondary px-1 py-0" data-toggle="modal" data-target="#help">
                     <i class="fa fa-question-circle" aria-hidden="true"></i>
                     Help
                  </button>
               </span>
            </div>
            
            <!--CARD BODY-->
            <div class="card-body card_body pb-0">
               <table id="datatable" class="table table-hover table-sm">
                  <thead>
                     <tr>
                        <th>Module</th>
                        <th>Name</th>
                        <th>Value</th>
                        <th>Created</th>
                        <th class="no-sort"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($categories as $category)
                        <tr>
                           <td>{{ $category->module->name }}</td>
                           <td>{{ $category->name }}</td>
                           <td>{{ $category->value }}</td>
                           <td>{{ $category->created_at->format('M d, Y') }}</td>
                           <td class="text-right">
                              @if(checkPerm('category_show'))
                                 <a class="btn btn-sm btn-outline-secondary px-1 py-0"
                                    href="{{ route('categories.show', $category->id) }}"
                                    title="View Category">
                                    <i class="far fa-eye"></i>
                                 </a>
                              @endif

                              @if(checkPerm('category_edit'))
                                 <a href="{{ route('categories.edit', $category->id) }}"
                                    class="btn btn-sm btn-outline-bprimary px-1 py-0"
                                    title="Edit Category">
                                    <i class="far fa-edit"></i>
                                 </a>
                              @endif

                              @if(checkPerm('category_delete'))
                                 <a href="{{ route('categories.delete', $category->id) }}"
                                    class="btn btn-sm btn-outline-danger px-1 py-0"
                                    title="Delete Category">
                                    <i class="far fa-trash-alt"></i>
                                 </a>
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

@endsection
