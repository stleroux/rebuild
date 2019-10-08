@extends('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop 

@section('left_column')
@endsection

@section('right_column')
   @include('blocks.member')
   @include('profile.blocks.contributions')
@endsection

@section('content')
   {!! Form::model($user, ['route'=>['profile.update', $user->id], 'method'=>'PUT', 'files'=>true]) !!}

      <div class="card mb-3">
         <div class="card-header section_header p-2">
            Edit Profile
            <span class="float-right">
               <div class="btn-group">
                  @include('profile.buttons.back', ['size'=>'xs'])
                  @include('profile.buttons.update', ['size'=>'xs'])
               </div>
            </span>
         </div>

         <div class="card-body section_body p-2">
            
            <div class="form-row">
               <div class="col-9">
                  {{-- Account Info --}}
                  <div class="card mb-2">
                     <div class="card-header card_header p-2">Account Info</div>
                     <div class="card-body section_body p-2">
                        <div class="form-row">
                           <div class="col-md-2">
                              <div class="form-group">
                                 {{ Form::label('username', 'Username') }}
                                 {{ Form::text('username', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 {{ Form::label('created_at', 'Member Since', ['class'=>'control-label']) }}
                                 {{ Form::text('created_at', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                              </div>
                           </div>
                           <div class="col-md-3 col-lg-2">
                              <div class="form-group">
                                 {{ Form::label('last_login_date', 'Last Login Date', ['class'=>'control-label']) }}
                                 {{ Form::text('last_login_date', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 {{ Form::label('login_count', 'Login Count', ['class'=>'control-label']) }}
                                 {{ Form::text('login_count', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                              </div>
                           </div>
                           {{-- <div class="col-md-2">
                              <div class="form-group">
                                 {{ Form::label('invoicer_client', 'Invoicer Client', ['class'=>'control-label']) }}
                                 <select name="invoicer_client" id="invoicer_client" class="form-control form-control-sm" disabled>
                                    @foreach($user->invoicerclientOptions() as $invoicerclientOptionKey => $invoicerclientOptionValue)
                                       <option value="{{$invoicerclientOptionKey}}" {{ $user->invoicerclientClient == $invoicerclientOptionValue ? 'selected' : '' }}>{{ $invoicerclientOptionValue }}</option>
                                    @endforeach
                                 </select>
                                 <div class="bg-danger">{{ $errors->first('invoicer_client') }}</div>
                              </div>
                           </div> --}}
                        </div>
                     </div>
                  </div>
                  {{-- Profile Info --}}
                  <div class="card mb-2">
                     <div class="card-header card_header p-2">Profile Info</div>
                     <div class="card-body section_body p-2">
                        <div class="form-row">
                           <div class="col-md-3">
                              <div class="form-group">
                                 {{ Form::label('first_name', 'First Name', ['class'=>'required']) }}
                                 {{ Form::text('first_name', null, ['class'=>'form-control form-control-sm', 'autofocus', 'onfocus'=>'this.focus();this.select()'] )}}
                                 <div class="pl-1 bg-danger">{{ $errors->first('first_name') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 {{ Form::label('last_name', 'Last Name', ['class'=>'required']) }}
                                 {{ Form::text('last_name', null, ['class'=>'form-control form-control-sm'])}}
                                 <div class="pl-1 bg-danger">{{ $errors->first('last_name') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 {{ Form::label('email', 'Email Address', ['class'=>'required']) }}
                                 {{ Form::text('email', null, ['class'=>'form-control form-control-sm']) }}
                                 <div class="pl-1 bg-danger">{{ $errors->first('email') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 {{ Form::label('public_email', 'Public Email') }}
                                 <i class="far fa-question-circle float-right" data-toggle="tooltip" data-placement="top" title="Do you want to show your email address to all users?"></i>
                                 {{ Form::select('public_email', ['No','Yes'], null, ['class'=>'form-control form-control-sm']) }}
                              </div>
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="col-md-2">
                              <div class="form-group">
                                 {{ Form::label('telephone', 'Telephone') }}
                                 {{ Form::text('telephone', null, ['class'=>'form-control form-control-sm']) }}
                                 <div class="pl-1 bg-danger">{{ $errors->first('telephone') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 {{ Form::label('cell', 'Cell Phone') }}
                                 {{ Form::text('cell', null, ['class'=>'form-control form-control-sm']) }}
                                 <div class="pl-1 bg-danger">{{ $errors->first('cell') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 {{ Form::label('fax', 'Fax') }}
                                 {{ Form::text('fax', null, ['class'=>'form-control form-control-sm']) }}
                                 <div class="pl-1 bg-danger">{{ $errors->first('fax') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 {{ Form::label('website', 'Website Address') }}
                                 {{ Form::text('website', null, ['class'=>'form-control form-control-sm']) }}
                                 <div class="pl-1 bg-danger">{{ $errors->first('website') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                        </div>

                        <div class="form-row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="company_name">Company Name</label>
                                 <input name="company_name" type="text" class="form-control form-control-sm" value="{{ $user->company_name }}">
                                 {{-- <span><small>Required for user to show up in the Invoicer</small></span> --}}
                              </div>
                           </div>
                        </div>
                        
                     </div>
                  </div>
               </div>

               <div class="col-3">
                  @include('profile.blocks.edit_image')
               </div>
            </div>

            {{-- Address Info --}}
            <div class="form-row">
               <div class="col">
                  <div class="card mb-2">
                     <div class="card-header card_header p-2">Address Info</div>
                     <div class="card-body section_body p-2">
                        <div class="form-row">
                           <div class="col-md-1">
                              <div class="form-group">
                                 {{ Form::label('civic_number', 'Unit N<sup>o</sup>', ['class'=>'control-label'], false) }}
                                 {{ Form::text('civic_number', null, ['class'=>'form-control form-control-sm']) }}
                                 <div class="pl-1 bg-danger">{{ $errors->first('civic_number') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 {{ Form::label('address_1', 'Address', ['class'=>'control-label']) }}
                                 {{ Form::text('address_1', null, ['class'=>'form-control form-control-sm']) }}
                                 <div class="pl-1 bg-danger">{{ $errors->first('address_1') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 {{ Form::label('address_2', 'Address 2', ['class'=>'control-label']) }}
                                 {{ Form::text('address_2', null, ['class'=>'form-control form-control-sm']) }}
                                 <div class="pl-1 bg-danger">{{ $errors->first('address_2') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                        </div>

                        <div class="form-row">
                           <div class="col-md-2">
                              <div class="form-group">
                                 {{ Form::label('city', 'City', ['class'=>'control-label']) }}
                                 {{ Form::text('city', null, ['class'=>'form-control form-control-sm']) }}
                                 <div class="pl-1 bg-danger">{{ $errors->first('city') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 {{ Form::label('province', 'Province / State', ['class'=>'control-label']) }}
                                 {{ Form::text('province', null, ['class'=>'form-control form-control-sm']) }}
                                 <div class="pl-1 bg-danger">{{ $errors->first('province') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 {{ Form::label('postal_code', 'Postal / Zip Code', ['class'=>'control-label']) }}
                                 {{ Form::text('postal_code', null, ['class'=>'form-control form-control-sm']) }}
                                 <div class="pl-1 bg-danger">{{ $errors->first('postal_code') }}</div>
                                 <small class="form-text"></small>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            {{-- Other Info --}}
            <div class="form-row">
               <div class="col">
                  <div class="card mb-2">
                     <div class="card-header card_header p-2">Other Info</div>
                     <div class="card-body section_body p-2">
                        <div class="form-row">
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <div class="form-group">
                                    {{ Form::label('notes', 'Notes', ['class'=>'control-label']) }}
                                    {{ Form::textarea('notes', null, ['class'=>'form-control form-control-sm', 'rows'=>2]) }}
                                    <div class="pl-1 bg-danger">{{ $errors->first('notes') }}</div>
                                    <small class="form-text"></small>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>
         
      </div>

   {{ Form::close() }}

@endsection
