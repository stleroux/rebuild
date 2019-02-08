@if(checkPerm('module_create'))
   {!! Form::open(['route' => 'modules.store']) !!}
      <div class="card">
         <div class="card-header block_header">New module</div>
         <div class="card-body pt-2 pb-1">
            {{-- <div class="row"> --}}
               {{-- <div class="col-xs-12"> --}}
                  <div class="row form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'Name', ['class'=>'required']) }}
                     {{ Form::text('name', null, ['class' => 'form-control form-control-sm', 'autofocus']) }}
                     <span class="text-danger">{{ $errors->first('name') }}</span>
                  </div>
               {{-- </div> --}}
            {{-- </div> --}}
            {{-- <div class="row"> --}}
               <div class="row form-group py-0">
               {{-- <div class="col-xs-12"> --}}
                  {{ Form::button('<div class=""><i class="fa fa-save"></i> Save</div>', array('type' => 'submit', 'class' => 'btn btn-sm btn-success btn-block')) }}
               {{-- </div> --}}
            </div>
         </div>
         <div class="card-footer px-2 py-1">
            <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
         </div>
      </div>
   {!! Form::close() !!}
@endif
