   {!! Form::open(['route' => 'admin.categories.store']) !!}
      <input type="hidden" name="part" value="sub">
      <div class="card mb-2">
         <div class="card-header section_header p-2">
            <i class="fa fa-plus" aria-hidden="true"></i>
            New Sub Category
            <span class="float-right">
               <div class="btn-group">
                  @include('admin.categories.buttons.help', ['size'=>'xs', 'bookmark'=>'categories_add_subCategory'])
                  @include('admin.categories.buttons.back', ['size'=>'xs'])
                  @include('admin.categories.buttons.reset', ['size'=>'xs'])
                  @include('admin.categories.buttons.save', ['size'=>'xs'])
               </div>
            </span>
         </div>
         <div class="card-body section_body p-2">
            <div class="row">
               <div class="col-3">
                  <div class="form-group">
                     {!! Form::label('sSubs','Main Category', ['class'=>'required']) !!}
                     <select name="sSubs" id="subs" class="form-control form-control-sm">
                        <option value="">Select One</option>
                        @foreach($categories as $k)
                           <option value="{{ $k['id'] }}">{{ ucwords($k['name']) }}</option>
                        @endforeach
                     </select>
                     <div class="pl-1 bg-danger">{{ $errors->first('sSubs') }} </div>
                  </div>
               </div>
               <div class="col-3">
                  <div class="form-group">
                     {{ Form::label('sName', 'Sub Category', ['class'=>'required']) }}
                     {{ Form::text('sName', null, ['class' => 'form-control form-control-sm']) }}
                     <div class="pl-1 bg-danger">{{ $errors->first('sName') }}</div>
                  </div>
               </div>
               <div class="col-3">
                  <div class="form-group">
                     {{ Form::label('sValue', 'Value') }}
                     {{ Form::text('sValue', null, ['class' => 'form-control form-control-sm', 'placeholder'=>'See Category Help for details.']) }}
                  </div>
               </div>
               <div class="w-100"></div>
               <div class="col">
                  <div class="form-group">
                     {{ Form::label('sDescription', 'Description') }}
                     {{ Form::text('sDescription', null, ['class' => 'form-control form-control-sm']) }}
                  </div>
               </div>
            </div>
         </div>

         <div class="card-footer p-1">
            <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
         </div>
      </div>
   {!! Form::close() !!}