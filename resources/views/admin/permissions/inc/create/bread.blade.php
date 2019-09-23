{!! Form::open(array('route' => 'admin.permissions.store')) !!}
   <input type="hidden" name="bread" value="bread">
   <div class="card mb-3">
      <!--CARD HEADER-->
      <div class="card-header card_header p-2">
         <i class="fas fa-user"></i>
         Add BREAD Permissions
         <span class="float-sm-right">
            <div class="btn-group">
               @include('admin.permissions.buttons.back', ['size'=>'xs'])
               @include('admin.permissions.buttons.reset', ['size'=>'xs'])
               @include('admin.permissions.buttons.save&new', ['size'=>'xs'])
               @include('admin.permissions.buttons.save', ['size'=>'xs'])
            </div>
         </span>
      </div>
      <div class="card-body section_body p-2">
         <div class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  {{ Form::label('b_model', 'Model', ['class'=>'required']) }}
                  {!! Form::text('b_model', null, array('class'=>'form-control form-control-sm')) !!}
                  <div class="pl-1 bg-danger">{{ $errors->first('b_model') }}</div>
                  <small class="form-text">Used for sorting and grouping permissions</small>
               </div>
            </div>
            {{-- <div class="col-sm-4">
               <div class="form-group {{ $errors->has('b_type') ? 'has-error' : '' }}">
                  <label for="b_type" class="required">Core Module?</label>
                     <select name="b_type" value="{{ old('type') ?? $permission->type }}" id="type" class="form-control form-control-sm">
                        @foreach($permission->typesOptions() as $typeOptionKey => $typeOptionValue)
                           <option value="{{ $typeOptionKey }}" {{ $permission->type == $typeOptionValue ? 'selected' : '' }}>{{ $typeOptionValue }}</option>
                        @endforeach
                     </select>
                  <span class="bg-danger text-dark">{{ $errors->first('b_type') }}</span>
               </div>
            </div> --}}
         </div>
      </div>
   </div>
{{ Form::close() }}