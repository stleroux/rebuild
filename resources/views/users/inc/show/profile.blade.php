<div class="card mb-2">
   <div class="card-body section_body p-2">
      

                  {{-- Profile Info --}}
                  <div class="form-row">
                     <div class="col-9">
                        <div class="card mb-2">
                           <div class="card-header card_header p-2">Profile Info</div>
                           <div class="card-body section_body p-2">
                              <div class="form-row">
                                 <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                       <label for="first_name" class="required">First Name</label>
                                       <input id="first_name" type="text" class="form-control form-control-sm" autofocus="autofocus" name="first_name" readonly="readonly" value="{{ $user->first_name }}">
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
                                       <input id="last_name" type="text" class="form-control form-control-sm" name="last_name" readonly="readonly" value="{{ $user->last_name }}">
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
                                       <input id="telephone" type="text" class="form-control form-control-sm" name="telephone" readonly="readonly" value="{{ $user->telephone }}">
                                    </div>
                                 </div>
                              </div>

                              <div class="form-row">
                                 <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                       {{ Form::label('email', 'Email Address', ['class'=>'required']) }}
                                       {{ Form::text('email', null, ['class' => 'form-control form-control-sm', 'readonly']) }}
                                       @if ($errors->has('email'))
                                          <span class="text-danger small">{{ $errors->first('email') }}</span>
                                       @endif
                                    </div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="public_email">Public Email</label>
                                       <i class="far fa-question-circle float-right" data-toggle="tooltip" data-placement="top" title="Do you want to show your email address to all users?"></i>
                                       <input id="public_email" type="text" class="form-control form-control-sm" name="public_email" readonly="readonly" value="{{ $user->public_email == 0 ? 'No' : 'Yes' }}">
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
                           <div class="card-footer card_footer p-1">
                              Fields marked with an <span class="required"></span> are required.
                           </div>
                        </div>
                     </div>
                     <div class="col-3">
                        @include('users.blocks.edit_image')
                     </div>
                  </div>

                  {{-- Address Info --}}
                  <div class="form-row">
                     <div class="col">
                        <div class="card mb-2">
                           <div class="card-header card_header p-2">Address Info</div>
                           <div class="card-body section_body p-2">
                              <div class="form-row">
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="civic_number" class=" control-label">Civic/Unit N<sup>o</sup></label>
                                       <input id="civic_number" type="text" class="form-control form-control-sm" name="civic_number" readonly="readonly" value="{{ $user->civic_number }}">
                                    </div>
                                 </div>
                                 <div class="col-sm-5">
                                    <div class="form-group">
                                       <label for="address1" class=" control-label">Address 1</label>
                                       <input id="address1" type="text" class="form-control form-control-sm" name="address1" readonly="readonly" value="{{ $user->address1 }}">
                                    </div>
                                 </div>
                                 <div class="col-sm-5">
                                    <div class="form-group">
                                       <label for="address2" class=" control-label">Address 2</label>
                                       <input id="address2" type="text" class="form-control form-control-sm" name="address2" readonly="readonly" value="{{ $user->address2 }}">
                                    </div>
                                 </div>
                              </div>

                              <div class="form-row">
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="city" class=" control-label">City</label>
                                       <input id="city" type="text" class="form-control form-control-sm" name="city" readonly="readonly" value="{{ $user->city }}">
                                    </div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="province" class=" control-label">Province/State</label>
                                       <input id="province" type="text" class="form-control form-control-sm" name="province" readonly="readonly" value="{{ $user->province }}">
                                    </div>                                    
                                 </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                       <label for="postal_code" class=" control-label">Postal/Zip Code</label>
                                       <input id="postal_code" type="text" class="form-control form-control-sm" name="postal_code" readonly="readonly" value="{{ $user->postal_code }}">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>


   </div>
</div>