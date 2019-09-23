{{-- OTHER INFORMATION --}}
<div class="card">
   <div class="card-header card_header p-1">Other Information</div>
   <div class="card-body section_body p-2">

      <div class="form-row pb-2">

         <div class="col-xs-12 col-sm-6 col-md-3">
            {!! Form::label('width', 'Width') !!} <small>(Inches)</small>
            <span class="float-right">
               <i class="fa fa-question-circle" title="Dimensions from left to right when facing the item"></i>
            </span>
            <div class="input-group input-group-sm">
               <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon2">
                     <i class="fas fa-ruler-horizontal"></i>
                  </span>
               </div>
               {!! Form::number('width', null, ['class' => 'form-control form-control-sm']) !!}
            </div>
            <div class="pl-1 bg-danger">{{ $errors->first('width') }}</div>
         </div>

         <div class="col-xs-12 col-sm-6 col-md-3">
            {!! Form::label('depth', 'Depth') !!} <small>(Inches)</small>
            <span class="float-right">
               <i class="fa fa-question-circle" title="Dimensions from front to back when facing the item"></i>
            </span>
            <div class="input-group input-group-sm">
               <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon2">
                     <i class="fas fa-ruler"></i>
                  </span>
               </div>
               {!! Form::number('depth', null, ['class' => 'form-control form-control-sm']) !!}
            </div>
            <div class="pl-1 bg-danger">{{ $errors->first('depth') }}</div>
         </div>

         <div class="col-xs-12 col-sm-6 col-md-3">
            {!! Form::label('height', 'Height') !!} <small>(Inches)</small>
            <span class="float-right">
               <i class="fa fa-question-circle" title="Dimensions from the floor up when facing the item"></i>
            </span>
            <div class="input-group input-group-sm">
               <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon2">
                     <i class="fas fa-ruler-vertical"></i>
                  </span>
               </div>
               {!! Form::number('height', null, ['class' => 'form-control form-control-sm']) !!}
            </div>
            <div class="pl-1 bg-danger">{{ $errors->first('height') }}</div>
         </div>

         <div class="col-xs-12 col-sm-6 col-md-3">
            {!! Form::label('weight', 'Weight') !!} <small>(In Lbs)</small>
            <span class="float-right">
               <i class="fa fa-question-circle" title="Total weight of the item"></i>
            </span>
            <div class="input-group input-group-sm">
               <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon2">
                     <i class="fas fa-balance-scale"></i>
                  </span>
               </div>
               {!! Form::number('weight', null, ['class' => 'form-control form-control-sm']) !!}
            </div>
            <div class="pl-1 bg-danger">{{ $errors->first('weight') }}</div>
         </div>

      </div>
      
      <div class="form-row pb-2">
         <div class="col-xs-12 col-sm-6 col-md-4">
            {!! Form::label('completed_at', 'Completed Date') !!}
            <div class="input-group input-group-sm">
               <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon2">
                     <i class="fa fa-calendar" aria-hidden="true"></i>
                  </span>
               </div>
               {{ Form::text('completed_at', null, ['class'=>'form-control form-control-sm', 'id'=>'datePicker']) }}
            </div>
            <div class="pl-1 bg-danger">{{ $errors->first('completed_at') }}</div>
         </div>

         <div class="col-xs-12 col-sm-6 col-md-3">
            {!! Form::label('price', 'Price') !!}
            <div class="input-group input-group-sm">
               <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon2">
                     <i class="fas fa-dollar-sign"></i>
                  </span>
               </div>
               {{ Form::number('price', null, ['class'=>'form-control form-control-sm']) }}
            </div>
            <div class="pl-1 bg-danger">{{ $errors->first('price') }}</div>
         </div>

         <div class="col-xs-12 col-sm-6 col-md-3">
            {!! Form::label('time_invested', 'Shop Time') !!} <small>(Hrs)</small>
            <div class="input-group input-group-sm">
               <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon2">
                     <i class="far fa-clock"></i>
                  </span>
               </div>
               {!! Form::number('time_invested', null, ['class' => 'form-control form-control-sm']) !!}
            </div>
            <div class="pl-1 bg-danger">{{ $errors->first('time_invested') }}</div>
         </div>


         
      </div>

   </div>
</div>