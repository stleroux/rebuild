   {!! Form::open(['route' => 'categories.store']) !!}
      <input type="hidden" name="part" value="category">
      <div class="card mb-3">
         <div class="card-header card_header">
            <i class="fa fa-plus" aria-hidden="true"></i>
            New Category
            <span class="float-right">
               @include('common.buttons.help', ['model'=>'category', 'type'=>''])
               @include('categories.blocks.help', ['model'=>'category', 'type'=>''])
               @include('common.buttons.cancel', ['model'=>'category', 'type'=>''])
               @include('common.buttons.reset', ['model'=>'category', 'type'=>''])
               @include('common.buttons.save', ['model'=>'category', 'type'=>''])
            </span>
         </div>
         <div class="card-body card_body pb-0">
            <div class="row">
               <div class="col-3">
                  <div class="form-group {{ $errors->has('cCategory') ? 'has-error' : '' }}">
                     {!! Form::label('cCategory','Main Category', ['class'=>'required']) !!}
                     <select name="cCategory" id="category" class="form-control input-sm">
                        <option value="">Select One</option>
                        @foreach($categories as $k)
                           <option value="{{ $k['id'] }}">{{ ucwords($k['name']) }}</option>
                        @endforeach
                     </select>
                     <span class="text-danger">{{ $errors->first('cCategory') }} </span>
                  </div>
               </div>

               <div class="col-3">
                  <div class="form-group {{ $errors->has('cSubcategory') ? 'has-error' : '' }}">
                     {!! Form::label('cSubcategory','Sub Category', ['class'=>'required']) !!}
                     <select name="cSubcategory" id="subcategory" class="form-control input-sm">
                        <option value=""></option>
                     </select>
                     <span class="text-danger">{{ $errors->first('cSubcategory') }} </span>
                  </div>
               </div>

               <div class="col-3">
                  <div class="form-group {{ $errors->has('cName') ? 'has-error' : '' }}">
                     {{ Form::label('cName', 'Category Name', ['class'=>'required']) }}
                     {{ Form::text('cName', null, ['class' => 'form-control form-control-sm']) }}
                     <span class="text-danger">{{ $errors->first('cName') }}</span>
                  </div>
               </div>
               <div class="col-3">
                  <div class="form-group {{ $errors->has('cValue') ? 'has-error' : '' }}">
                     {{ Form::label('cVlue', 'Value') }}
                     {{ Form::text('cValue', null, ['class' => 'form-control form-control-sm', 'placeholder'=>'See Category Help for details.']) }}
                     <span class="text-danger">{{ $errors->first('cValue') }}</span>
                  </div>
               </div>
               <div class="w-100"></div>
               <div class="col">
                  <div class="form-group {{ $errors->has('cDescription') ? 'has-error' : '' }}">
                     {{ Form::label('cDescription', 'Description') }}
                     {{ Form::text('cDescription', null, ['class' => 'form-control form-control-sm']) }}
                     <span class="text-danger">{{ $errors->first('cDescription') }}</span>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-footer px-1 py-1">
            <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
         </div>
      </div>
   {!! Form::close() !!}