{{-- <div class="card-body card_body"> --}}
   {!! Form::open(array('route' => 'settings.store', 'method'=>'POST')) !!}
      <div class="card mb-2">
         <div class="card-header card_header">
            <i class="fas fa-plus-square"></i>
            New Site Setting
         </div>
         
         <div class="card-body card_body px-0">
            <div class="col">
               <div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
                  {{-- {{ Form::label('key', 'Key', ['class'=>'required']) }} --}}
                  {!! Form::text('key', null, array('class'=>'form-control form-control-sm', 'autofocus'=>'autofocus', 'placeholder'=>'Key')) !!}
                  <span class="text-danger">{{ $errors->first('key') }}</span>
               </div>
            </div>
            <div class="col">
               <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                  {{-- {{ Form::label('value', 'Value Name', ['class'=>'required']) }} --}}
                  {!! Form::text('value', null, array('class'=>'form-control form-control-sm', 'placeholder'=>'Value')) !!}
                  <span class="text-danger">{{ $errors->first('value') }}</span>
               </div>
            </div>
            <div class="col">
               <div class="form-group {{ $errors->has('tab') ? 'has-error' : '' }}">
                  {{-- {{ Form::label('tab', 'Tab : ', ['class'=>'_required']) }} --}}
                  {!! Form::select('tab', ['general'=>'General', 'profile'=>'Profile', 'contact'=>'Contact'], null, ['placeholder'=>'Select a Tab', 'class'=>'form-control form-control-sm']) !!}
                  <span class="text-danger">{{ $errors->first('tab') }}</span>
               </div>
            </div>
            <div class="col">
               <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                  {{-- {{ Form::label('description', 'Description', ['class'=>'required']) }} --}}
                  {!! Form::textarea('description', null, array('class'=>'form-control form-control-sm', 'rows'=>'3', 'placeholder'=>'Description')) !!}
                  <span class="text-danger">{{ $errors->first('description') }}</span>
               </div>
            </div>
            <div class="col">
               <button type="submit" class="btn btn-sm btn-block btn-outline-success px-1 py-0">
                  <i class="far fa-save"></i> Save
               </button>
               <input type="reset" value="Reset Form" class="btn btn-sm btn-block btn-outline-warning px-1 py-0">
            </div>
         </div>

         {{-- <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div> --}}
      </div>
   {!! Form::close() !!}
{{-- </div> --}}
