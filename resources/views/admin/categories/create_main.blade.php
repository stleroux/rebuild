{{-- {!! Form::open(['route' => 'admin.categories.store']) !!} --}}
{{-- <form action="{{ route('admin.categories.store') }}"> --}}
<form>
   @csrf
   <input type="hidden" name="part" value="main">
   <div class="card mb-3">
      <div class="card-header section_header p-2">
         <i class="fa fa-plus" aria-hidden="true"></i>
         New Parent Category
         <span class="float-right">
            <div class="btn-group">
               @include('admin.categories.buttons.help', ['size'=>'xs', 'bookmark'=>'categories_add_mainCategory'])
               @include('admin.categories.buttons.back', ['size'=>'xs'])
               @include('admin.categories.buttons.reset', ['size'=>'xs'])
               @include('admin.categories.buttons.btn_save', ['size'=>'xs'])
            </div>
         </span>
      </div>
      <div class="card-body section_body p-2">
         <div class="row">
            <div class="col-3">
               <div class="form-group">
                  <label for="mName" class="required">Main Category</label>
                  <input type="text" name="mName" class="form-control form-control-sm">
                  <div class="pl-1 bg-danger">{{ $errors->first('mName') }}</div>
               </div>
            </div>
            <div class="col-3">
               <div class="form-group">
                  <label for="mValue">Value</label>
                  <input type="text" name="mValue" class="form-control form-control-sm" placeholder="See Category Help for details." />
               </div>
            </div>
            <div class="w-100"></div>
            <div class="col">
               <div class="form-group">
                  <label for="mDescription">Description</label>
                  <input type="text" name="mDescription" class="form-control form-control-sm">
               </div>
            </div>
         </div>
      </div>

      <div class="card-footer px-1 py-1">
         <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
      </div>
   </div>
{!! Form::close() !!}
