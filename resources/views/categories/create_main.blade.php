   {!! Form::open(['route' => 'categories.store']) !!}
      <input type="hidden" name="part" value="main">
      <div class="card mb-3">
         <div class="card-header section_header p-2">
            <i class="fa fa-plus" aria-hidden="true"></i>
            New Parent Category
            <span class="float-right">
               <div class="btn-group">
                  @include('categories.buttons.help', ['size'=>'xs', 'bookmark'=>'categories_add_mainCategory'])
                  @include('categories.buttons.back', ['size'=>'xs'])
                  @include('categories.buttons.reset', ['size'=>'xs'])
                  @include('categories.buttons.save', ['size'=>'xs'])
               </div>
            </span>
         </div>
         <div class="card-body section_body p-2">
            <div class="row">
               <div class="col-3">
                  <div class="form-group {{ $errors->has('mName') ? 'has-error' : '' }}">
                     {{ Form::label('mName', 'Main Category', ['class'=>'required']) }}
                     {{ Form::text('mName', null, ['class' => 'form-control form-control-sm']) }}
                     <span class="text-danger">{{ $errors->first('mName') }}</span>
                  </div>
               </div>
               <div class="col-3">
                  <div class="form-group {{ $errors->has('mValue') ? 'has-error' : '' }}">
                     {{ Form::label('mValue', 'Value') }}
                     {{ Form::text('mValue', null, ['class' => 'form-control form-control-sm', 'placeholder'=>'See Category Help for details.']) }}
                     <span class="text-danger">{{ $errors->first('mValue') }}</span>
                  </div>
               </div>
               <div class="w-100"></div>
               <div class="col">
                  <div class="form-group {{ $errors->has('mDescription') ? 'has-error' : '' }}">
                     {{ Form::label('mDescription', 'Description') }}
                     {{ Form::text('mDescription', null, ['class' => 'form-control form-control-sm']) }}
                     <span class="text-danger">{{ $errors->first('mDescription') }}</span>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-footer px-1 py-1">
            <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
         </div>
      </div>
   {!! Form::close() !!}