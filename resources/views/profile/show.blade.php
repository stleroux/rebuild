@extends('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop    

@section('left_column')
   {{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
   @include('blocks.member')
   @include('profile.blocks.contributions')
@endsection

@section('content')

{!! Form::model($user, ['route'=>['profile.show', $user->id], 'method'=>'GET']) !!}
   <div class="card mb-3">

      <div class="card-header section_header p-2">
         Show Profile
         <span class="float-right">
            <div class="btn-group">
               {{-- @include('projects.addins.links.help', ['size'=>'xs', 'bookmark'=>'projects']) --}}
               {{-- @include('users.buttons.back', ['size'=>'xs']) --}}
               @if($user->id === Auth::user()->id)
                  <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-xs btn-primary">
                     <i class="fa fa-edit"></i>
                     Edit Profile
                  </a>
               @endif
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
                              <label>Total Permissions</label>
                              <input type="text" class="form-control form-control-sm" value="{{ $user->permissions->count() }}" disabled>
                           </div>
                        </div> --}}
                        {{-- <div class="col-md-2">
                           <div class="form-group">
                              <label>Invoicer Client</label>
                              <input type="text" class="form-control form-control-sm" value="{{ $user->invoicer_client }}" disabled>
                           </div>
                        </div> --}}
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="status">Invoicer Client</label>
                              <select name="invoicer_client" id="invoicer_client" class="form-control form-control-sm" disabled>
                                 @foreach($user->invoicerclientOptions() as $invoicerclientOptionKey => $invoicerclientOptionValue)
                                    <option value="{{$invoicerclientOptionKey}}" {{ $user->invoicerclientClient == $invoicerclientOptionValue ? 'selected' : '' }}>{{ $invoicerclientOptionValue }}</option>
                                 @endforeach
                              </select>
                              <div class="bg-danger">{{ $errors->first('invoicer_client') }}</div>
                           </div>
                        </div>
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
                              {{ Form::label('first_name', 'First Name', ['class'=>'']) }}
                              {{ Form::text('first_name', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly'] )}}
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              {{ Form::label('last_name', 'Last Name', ['class'=>'']) }}
                              {{ Form::text('last_name', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly'])}}
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              {{ Form::label('email', 'Email Address', ['class'=>'']) }}
                              {{ Form::text('email', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              {{ Form::label('public_email', 'Public Email') }}
                              <i class="far fa-question-circle float-right" data-toggle="tooltip" data-placement="top" title="Do you want to show your email address to all users?"></i>
                              {{ Form::select('public_email', ['No','Yes'], null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                           </div>
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="col-md-2">
                           <div class="form-group">
                              {{ Form::label('telephone', 'Telephone') }}
                              {{ Form::text('telephone', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              {{ Form::label('cell', 'Cell Phone') }}
                              {{ Form::text('cell', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              {{ Form::label('fax', 'Fax') }}
                              {{ Form::text('fax', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              {{ Form::label('website', 'Website Address') }}
                              {{ Form::text('website', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-3">
               @include('profile.blocks.image')
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
                              {{ Form::text('civic_number', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              {{ Form::label('address_1', 'Address', ['class'=>'control-label']) }}
                              {{ Form::text('address_1', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              {{ Form::label('address_2', 'Address 2', ['class'=>'control-label']) }}
                              {{ Form::text('address_2', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                           </div>
                        </div>
                     </div>

                     <div class="form-row">
                        <div class="col-md-2">
                           <div class="form-group">
                              {{ Form::label('city', 'City', ['class'=>'control-label']) }}
                              {{ Form::text('city', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              {{ Form::label('province', 'Province / State', ['class'=>'control-label']) }}
                              {{ Form::text('province', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
                           </div>                                    
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              {{ Form::label('postal_code', 'Postal / Zip Code', ['class'=>'control-label']) }}
                              {{ Form::text('postal_code', null, ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
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
                              {{ Form::label('notes', 'Notes', ['class'=>'control-label']) }}
                                    {{ Form::textarea('notes', null, ['class'=>'form-control form-control-sm', 'rows'=>2, 'readonly'=>'readonly']) }}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
      </div>

   </div>

@endsection
