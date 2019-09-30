<div class="card mb-2">
   <div class="card-body section_body p-2">
      <div class="form-row">
         <div class="col-9">

            {{-- Account Info --}}
            <div class="card mb-2">
               <div class="card-header card_header p-2">Account Info</div>
               <div class="card-body section_body p-2">
                  <div class="form-row">
                     <div class="col-sm-2">
                        <div class="form-group">
                           <label for="username">Username</label>
                           <input id="username" type="text" class="form-control form-control-sm" name="username" value="{{ $user->username }}" disabled />
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           <label for="created_at">Created On</label>
                           @if($user->created_at)
                              <input id="created_at" type="text" class="form-control form-control-sm" name="created_at" value="{{ $user->created_at }}" disabled>
                           @else
                              <input id="created_at" type="text" class="form-control form-control-sm" name="created_at" value="Unknown" disabled />
                           @endif
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           <label for="last_login_date">Last Login Date</label>
                           <input id="last_login_date" type="text" class="form-control form-control-sm" name="last_login_date" value="{{ $user->last_login_date }}" disabled />
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           <label for="login_count">Login Count</label>
                           <input id="login_count" type="text" class="form-control form-control-sm" name="login_count" value="{{ $user->login_count }}" disabled />
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label>Total permissions</label>
                           <input type="text" class="form-control form-control-sm" value="{{ $user->permissions->count() }}" disabled>
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
                           <label for="first_name">First Name</label>
                           <input id="first_name" type="text" class="form-control form-control-sm" autofocus="autofocus" name="first_name" value="{{ $user->first_name }}" disabled />
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="last_name">Last Name</label>
                           <input id="last_name" type="text" class="form-control form-control-sm" name="last_name" value="{{ $user->last_name }}" disabled />
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           {{ Form::label('email', 'Email Address') }}
                           {{ Form::text('email', null, ['class' => 'form-control form-control-sm', 'disabled']) }}
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           <label for="public_email">Public Email</label>
                           <i class="far fa-question-circle float-right" data-toggle="tooltip" data-placement="top" title="Do you want to show your email address to all users?"></i>
                           <input id="public_email" type="text" class="form-control form-control-sm" name="public_email" value="{{ $user->public_email == 0 ? 'No' : 'Yes' }}" disabled />
                        </div>
                     </div>
                  </div>

                  <div class="form-row">
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="telephone">Telephone</label>
                           <input id="telephone" type="text" class="form-control form-control-sm" name="telephone" value="{{ $user->telephone }}" disabled />
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="cell">Cell</label>
                           <input id="cell" type="text" class="form-control form-control-sm" name="cell" value="{{ $user->cell }}" disabled />
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="fax">Fax</label>
                           <input id="fax" type="text" class="form-control form-control-sm" name="fax" value="{{ $user->fax }}" disabled />
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="website">Website</label>
                           <input id="website" type="text" class="form-control form-control-sm" name="website" value="{{ $user->website }}" disabled />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      
         <div class="col-3">
            @include('admin.users.blocks.image')
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
                           <input id="civic_number" type="text" class="form-control form-control-sm" name="civic_number" value="{{ $user->civic_number }}" disabled />
                        </div>
                     </div>
                     <div class="col-sm-5">
                        <div class="form-group">
                           <label for="address1" class=" control-label">Address 1</label>
                           <input id="address1" type="text" class="form-control form-control-sm" name="address1" value="{{ $user->address1 }}" disabled />
                        </div>
                     </div>
                     <div class="col-sm-5">
                        <div class="form-group">
                           <label for="address2" class=" control-label">Address 2</label>
                           <input id="address2" type="text" class="form-control form-control-sm" name="address2" value="{{ $user->address2 }}" disabled />
                        </div>
                     </div>
                  </div>

                  <div class="form-row">
                     <div class="col-sm-2">
                        <div class="form-group">
                           <label for="city" class=" control-label">City</label>
                           <input id="city" type="text" class="form-control form-control-sm" name="city" value="{{ $user->city }}" disabled />
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           <label for="province" class=" control-label">Province/State</label>
                           <input id="province" type="text" class="form-control form-control-sm" name="province" value="{{ $user->province }}" disabled />
                        </div>                                    
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           <label for="postal_code" class=" control-label">Postal/Zip Code</label>
                           <input id="postal_code" type="text" class="form-control form-control-sm" name="postal_code" value="{{ $user->postal_code }}" disabled />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>
</div>
