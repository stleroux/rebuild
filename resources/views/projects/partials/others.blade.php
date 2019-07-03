{{-- OTHER INFORMATION --}}
<div class="card">
   <div class="card-header p-1">Other Information</div>
   <div class="card-body p-2">

      <div class="form-row">
         <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group {{ $errors->has('width') ? 'has-error' : '' }}">
               {!! Form::label('width', 'Width') !!} <small>(Inches)</small>
               <span class="float-right">
                  <i class="fa fa-question-circle" title="Dimensions from left to right when facing the item"></i>
               </span>
               {!! Form::number('width', null, ['class' => 'form-control form-control-sm']) !!}
               <span class="text-danger">{{ $errors->first('width') }}</span>
            </div>
         </div>
      
         <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group {{ $errors->has('depth') ? 'has-error' : '' }}">
               {!! Form::label('depth', 'Depth') !!} <small>(Inches)</small>
               <span class="float-right">
                  <i class="fa fa-question-circle" title="Dimensions from front to back when facing the item"></i>
               </span>
               {!! Form::number('depth', null, ['class' => 'form-control form-control-sm']) !!}
               <span class="text-danger">{{ $errors->first('depth') }}</span>
            </div>
         </div>

         <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group {{ $errors->has('height') ? 'has-error' : '' }}">
               {!! Form::label('height', 'Height') !!} <small>(Inches)</small>
               <span class="float-right">
                  <i class="fa fa-question-circle" title="Dimensions from the floor up when facing the item"></i>
               </span>
               {!! Form::number('height', null, ['class' => 'form-control form-control-sm']) !!}
               <span class="text-danger">{{ $errors->first('height') }}</span>
            </div>
         </div>

         <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
               {!! Form::label('weight', 'Weight') !!} <small>(In Lbs)</small>
               {!! Form::number('weight', null, ['class' => 'form-control form-control-sm']) !!}
               <span class="text-danger">{{ $errors->first('weight') }}</span>
            </div>
         </div>

      </div>
      
      <div class="form-row">
         <div class="col-xs-12 col-sm-6 col-md-4">
            {!! Form::label('completed_at', 'Completed Date') !!}
            <div class="input-group input-group-sm {{ $errors->has('completed_at') ? 'has-error' : '' }}">
               {{ Form::text('completed_at', null, ['class'=>'form-control form-control-sm', 'id'=>'datetime']) }}
               <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon2">
                     <i class="fa fa-calendar" aria-hidden="true"></i>
                  </span>
               </div>
               <span class="text-danger">{{ $errors->first('completed_at') }}</span>
            </div>
         </div>

         <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
               {!! Form::label('price', 'Price') !!}
               {!! Form::number('price', null, ['class' => 'form-control form-control-sm']) !!}
               <span class="text-danger">{{ $errors->first('price') }}</span>
            </div>
         </div>

         <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
               {!! Form::label('time_invested', 'Shop Time') !!} <small>(Hrs)</small>
               {!! Form::number('time_invested', null, ['class' => 'form-control form-control-sm']) !!}
               <span class="text-danger">{{ $errors->first('time_invested') }}</span>
            </div>
         </div>
      </div>

   </div>
</div>