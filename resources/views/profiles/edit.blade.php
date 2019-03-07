@extends('layouts.master')

@section ('stylesheets')
   {{-- {{ Html::style('css/woodbarn.css') }} --}}
@stop 

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('profiles.block_edit_image')
@endsection

@section('content')
   {!! Form::model($user, ['route'=>['profile.update', $user->id], 'method'=>'PUT', 'files'=>true]) !!}

      <div class="row">
         <div class="col">
            <div class="card mb-3">
               <div class="card-header card_header">
                  Edit Profile
                  <span class="float-right">
                     @include('common.buttons.cancel', ['model'=>'profile', 'type'=>''])
                     {{ Form::button('<i class="fa fa-save"></i> Update Profile', array('type'=>'submit', 'class'=>'btn btn-sm btn-outline-secondary px-1 py-0')) }}
                  </span>
               </div>

               <div class="card-body card_body">

                  {{-- Profile Info --}}
                  <div class="form-row">
                     <div class="col">
                        <div class="card mb-2">
                           <div class="card-header card_header_2">Profile Info</div>
                           <div class="card-body card_body">
                              <div class="form-row">
                                 <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                       <label for="first_name" class="required">First Name</label>
                                       <input id="first_name" type="text" class="form-control form-control-sm" autofocus="autofocus" name="first_name" value="{{ $user->profile->first_name }}">
                                       @if ($errors->has('first_name'))
                                          <span class="text-danger small">
                                             {{ $errors->first('first_name') }}
                                          </span>
                                       @endif
                                    </div>
                                 </div>
                                 <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                       <label for="last_name" class="required">Last Name</label>
                                       <input id="last_name" type="text" class="form-control form-control-sm" name="last_name" value="{{ $user->profile->last_name }}">
                                       @if ($errors->has('last_name'))
                                          <span class="text-danger small">
                                             {{ $errors->first('last_name') }}
                                          </span>
                                       @endif
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                       <label for="telephone">Telephone</label>
                                       <input id="telephone" type="text" class="form-control form-control-sm" name="telephone" value="{{ $user->profile->telephone }}">
                                    </div>
                                 </div>
                              </div>

                              <div class="form-row">
                                 <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                       {{ Form::label('email', 'Email Address', ['class'=>'required']) }}
                                       {{ Form::text('email', null, ['class' => 'form-control form-control-sm']) }}
                                       @if ($errors->has('email'))
                                          <span class="text-danger small">{{ $errors->first('email') }}</span>
                                       @endif
                                    </div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="public_email">Public Email</label>
                                       <i class="far fa-question-circle float-right" data-toggle="tooltip" data-placement="top" title="Do you want to show your email address to all users?"></i>
                                       {{ Form::select('public_email', ['No','Yes'], null, ['class'=>'form-control form-control-sm']) }}
                                    </div>
                                 </div>
                              </div>

                              <div class="form-row">
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="username">Username</label>
                                       <input id="username" type="text" class="form-control form-control-sm" name="username" readonly="readonly" value="{{ $user->username }}">
                                    </div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="created_at">Created On</label>
                                       @if($user->created_at)
                                          <input id="created_at" type="text" class="form-control form-control-sm" name="created_at" readonly="readonly" value="{{ $user->created_at }}">
                                       @else
                                          <input id="created_at" type="text" class="form-control form-control-sm" name="created_at" readonly="readonly" value="Unknown">
                                       @endif
                                    </div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="last_login_date">Last Login Date</label>
                                       <input id="last_login_date" type="text" class="form-control form-control-sm" name="last_login_date" readonly="readonly" value="{{ $user->last_login_date->format('M d, Y') }}">
                                    </div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="login_count">Login Count</label>
                                       <input id="login_count" type="text" class="form-control form-control-sm" name="login_count" readonly="readonly" value="{{ $user->login_count }}">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card-footer px-1 py-0">
                              Fields marked with an <span class="required"></span> are required.
                           </div>
                        </div>
                     </div>
                     
                  </div>

                  {{-- Address Info --}}
                  <div class="form-row">
                     <div class="col">
                        <div class="card mb-2">
                           <div class="card-header card_header_2">Address Info</div>
                           <div class="card-body card_body">
                              <div class="form-row">
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="civic_number" class=" control-label">Civic/Unit N<sup>o</sup></label>
                                       <input id="civic_number" type="text" class="form-control form-control-sm" name="civic_number" value="{{ $user->profile->civic_number }}">
                                    </div>
                                 </div>
                                 <div class="col-sm-5">
                                    <div class="form-group">
                                       <label for="address1" class=" control-label">Address 1</label>
                                       <input id="address1" type="text" class="form-control form-control-sm" name="address1" value="{{ $user->profile->address1 }}">
                                    </div>
                                 </div>
                                 <div class="col-sm-5">
                                    <div class="form-group">
                                       <label for="address2" class=" control-label">Address 2</label>
                                       <input id="address2" type="text" class="form-control form-control-sm" name="address2" value="{{ $user->profile->address2 }}">
                                    </div>
                                 </div>
                              </div>

                              <div class="form-row">
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="city" class=" control-label">City</label>
                                       <input id="city" type="text" class="form-control form-control-sm" name="city" value="{{ $user->profile->city }}">
                                    </div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="province" class=" control-label">Province/State</label>
                                       <input id="province" type="text" class="form-control form-control-sm" name="province" value="{{ $user->profile->province }}">
                                    </div>                                    
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="postal_code" class=" control-label">Postal/Zip Code</label>
                                       <input id="postal_code" type="text" class="form-control form-control-sm" name="postal_code" value="{{ $user->profile->postal_code }}">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  {{-- Preferences Info --}}
                  <div class="row">
                     <div class="col">
                        <div class="card mb-2">
                           <div class="card-header card_header_2">
                              User Preferences 
                              <span class="text-dark">(Features marked with  <i class="far fa-check-square"></i> have been implemented in code)</span>
                              <span class="float-right">
                                 <a href="{{ route('profile.resetPreferences', $user->profile->id) }}" class="btn btn-sm btn-outline-primary px-1 py-0">Reset All Defaults</a>
                              </span>
                           </div>

                           <div class="card-body card_body">
                              <table class="table table-sm table-hover mb-2">
                                 <thead>
                                    <tr>
                                       <td><i class="far fa-check-square"></i></td>
                                       <th>Title</th>
                                       <th>Option</th>
                                       <th>Description</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    {{-- ACTION BUTTONS --}}
                                    <tr>
                                       <td></td>
                                       <td>Action Buttons</td>
                                       <td>
                                          {{ Form::select('action_buttons', array(
                                             '1' => 'Icons and Text (Default)',
                                             '2' => 'Icons only',
                                             '3' => 'Text Only',
                                             ), $user->profile->action_buttons, array('class'=>'form-control form-control-sm'))
                                          }}
                                       </td>
                                       <td>Changes the appearance of some buttons (Edit & Delete only at the moment).</td>
                                    </tr>
                                    {{-- ALERT FADE TIME --}}
                                    <tr>
                                       <td><i class="far fa-check-square"></i></td>
                                       <td>Alert Fade Time</td>
                                       <td>
                                          {{ Form::select('alert_fade_time', array(
                                             '2000' => '2 seconds',
                                             '3000' => '3 seconds',
                                             '4000' => '4 seconds',
                                             '5000' => '5 seconds (Default)',
                                             '6000' => '6 seconds',
                                             '7000' => '7 seconds',
                                             '8000' => '8 seconds',
                                             '9000' => '9 seconds',
                                             '10000' => '10 seconds',
                                             '15000' => '15 seconds',
                                             '20000' => '20 seconds',
                                             '1000000000' => 'Forever',
                                             ), $user->profile->alert_fade_time, array('class'=>'form-control form-control-sm'))
                                          }}
                                       </td>
                                       <td>Changes the length of time the alerts will be displayed.</td>
                                    </tr>
                                    {{-- AUTHOR FORMAT --}}
                                    <tr>
                                       <td></td>
                                       <td>Author Format</td>
                                       <td>
                                          {{ Form::select('author_format', array(
                                             '1' => 'Username (Default)' ,
                                             '2' => 'Last Name, First Name',
                                             '3' => 'First Name Last Name'
                                             ), $user->profile->author_format, array('class'=>'form-control form-control-sm'))
                                          }}
                                       </td>
                                       <td>Changes the way the author's name will be displayed.</td>
                                    </tr>
                                    {{-- DATE FORMAT --}}
                                    <tr>
                                       <td></td>
                                       <td>Date Format</td>
                                       <td>
                                          {{ Form::select('date_format', array(
                                             '1' => 'Jan 01, 2017 (Default)',
                                             '2' => 'Jan 1, 2017',
                                             '3' => '01/01/2017 (M-D-Y)',
                                             '4' => '1/01/2017 (M-D-Y)',
                                             '5' => '01 Jan 2017',
                                             '6' => '1 Jan 2017',
                                             '7' => '01/01/2017 (D-M-Y)',
                                             '8' => '1/01/2017 (D-M-Y)',
                                             ), $user->profile->date_format, array('class'=>'form-control form-control-sm'))
                                          }}
                                       </td>
                                       <td>Changes the way the dates are displayed.</td>
                                    </tr>
                                    {{-- LANDING PAGE --}}
                                    <tr>
                                       <td></td>
                                       <td>Landing Page</td>
                                       <td>
                                          {{-- {{ Form::select('landing_page_id', $landingPages, $user->profile->landing_page_id , ['class' => 'form-control form-control-sm']) }} --}}
                                       </td>
                                       <td>The page you will be redirected to when you log in to the site.</td>
                                    </tr>
                                    {{-- ROWS PER PAGE --}}
                                    <tr>
                                       <td></td>
                                       <td>Rows Per Page</td>
                                       <td>
                                          {{ Form::select('rows_per_page', array(
                                             '5' => '5',
                                             '10' => '10',
                                             '15' => '15 (Default)',
                                             '20' => '20',
                                             '25' => '25',
                                             '50' => '50',
                                             '100' => '100'
                                             ), $user->profile->rows_per_page, array('class'=>'form-control form-control-sm'))
                                          }}
                                       </td>
                                       <td>Changes the number of entries displayed in grids.</td>
                                    </tr>
                                    {{-- FRONTEND STYLE --}}
                                    <tr>
                                       <td></td>
                                       <td>Frontend Style</td>
                                       <td>
                                          {{ Form::select('frontendStyle', array(
                                             'bootstrap' => 'Bootstrap',
                                             'cerulean' => 'Cerulean',
                                             'cosmo' => 'Cosmo',
                                             'cyborg'=>'Cyborg',
                                             'darkly'=>'Darkly',
                                             'flatly'=>'Flatly',
                                             'journal'=>'Journal',
                                             'lumen'=>'Lumen',
                                             'paper'=>'Paper',
                                             'readable'=>'Readable',
                                             'sandstone'=>'Sandstone',
                                             'simplex'=>'Simplex',
                                             'slate'=>'Slate (Default)',
                                             'spacelab'=>'SpaceLab',
                                             'superhero'=>'SuperHero',
                                             'united'=>'United',
                                             'yeti'=>'Yeti',
                                             ), $user->profile->frontendStyle, array('class'=>'form-control form-control-sm'))
                                          }}
                                       </td>
                                       <td>Choosing a different style will change the apperance of the whole site.</td>
                                    </tr>
                                    {{-- BACKEND STYLE --}}
                                    <tr>
                                       <td></td>
                                       <td>Backend Style</td>
                                       <td>
                                          {{ Form::select('backendStyle', array(
                                             'bootstrap' => 'Bootstrap (Default)',
                                             'cerulean' => 'Cerulean',
                                             'cosmo' => 'Cosmo',
                                             'cyborg'=>'Cyborg',
                                             'darkly'=>'Darkly',
                                             'flatly'=>'Flatly',
                                             'journal'=>'Journal',
                                             'lumen'=>'Lumen',
                                             'paper'=>'Paper',
                                             'readable'=>'Readable',
                                             'sandstone'=>'Sandstone',
                                             'simplex'=>'Simplex',
                                             'slate'=>'Slate',
                                             'spacelab'=>'SpaceLab',
                                             'superhero'=>'SuperHero',
                                             'united'=>'United',
                                             'yeti'=>'Yeti',
                                             ), $user->profile->backendStyle, array('class'=>'form-control form-control-sm'))
                                          }}
                                       </td>
                                       <td>Choosing a different style will change the apperance of the whole site.</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           {{-- BACKEND STYLE --}}
                           <input type="hidden" name="backendStyle" value="{{ $user->profile->backendStyle }}">

                        </div>
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </div>

   {{ Form::close() }}

@endsection
