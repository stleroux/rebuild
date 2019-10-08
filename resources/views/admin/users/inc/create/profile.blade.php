<div class="card mb-2">
   <div class="card-body section_body p-2">
      
      <div class="form-row">
         <div class="col-9">
            {{-- Account Info --}}
            <div class="card mb-2">
               <div class="card-header card_header p-2">Account Info</div>
               <div class="card-body section_body p-2">
                  <div class="form-row">
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="username" class="required">Username</label>
                           <input name="username" type="text" class="form-control form-control-sm" value="{{ old('username') }}">
                           <div class="bg-danger">{{ $errors->first('username') }}</div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="password" class="required">Password</label>
                           <input name="password" type="text" class="form-control form-control-sm" value="" placeholder="Auto set to password if not set">
                        </div>
                     </div>
                     {{-- <div class="col-md-2">
                        <div class="form-group">
                           <label for="status">Invoicer Client</label>
                           <select name="invoicer_client" id="invoicer_client" class="form-control form-control-sm">
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
                           <label for="first_name">First Name</label>
                           <input name="first_name" type="input-text" class="form-control form-control-sm" value="{{ old('first_name') }}">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="last_name">Last Name</label>
                           <input name="last_name" type="text" class="form-control form-control-sm" value="{{ old('last_name') }}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="email" class="required">Email Address</label>
                           <input name="email" type="text" class="form-control form-control-sm" value="{{ old('email') }}">
                           <div class="bg-danger">{{ $errors->first('email') }}</div>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="public_email">Public Email</label>
                           <i class="far fa-question-circle float-right" data-toggle="tooltip" data-placement="top" title="Do you want to show your email address to all users?"></i>
                           {{ Form::select('public_email', ['No','Yes'], null, ['class'=>'form-control form-control-sm']) }}
                        </div>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="telephone">Telephone</label>
                           <input name="telephone" type="text" class="form-control form-control-sm" value="{{ old('telephone') }}">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="cell">Cell Phone</label>
                           <input name="cell" type="text" class="form-control form-control-sm" value="{{ old('cell') }}">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="fax">Fax</label>
                           <input name="fax" type="text" class="form-control form-control-sm" value="{{ old('fax') }}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="website">Website</label>
                           <input name="website" type="text" class="form-control form-control-sm" value="{{ old('website') }}">
                        </div>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="company_name">Company Name</label>
                           <input name="company_name" type="text" class="form-control form-control-sm" value="{{ old('company_name') }}">
                           <span><small>Required for user to show up in the Invoicer</small></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-3">
            @include('admin.users.blocks.edit_image')
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
                           <label for="civic_number" class="control-label">Unit N<sup>o</sup></label>
                           <input name="civic_number" type="text" class="form-control form-control-sm" value="{{ old('civic_number') }}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="address_1" class="control-label">Address 1</label>
                           <input name="address_1" type="text" class="form-control form-control-sm" value="{{ old('address_1') }}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="address_2" class="control-label">Address 2</label>
                           <input name="address_2" type="text" class="form-control form-control-sm" value="{{ old('address_2') }}">
                        </div>
                     </div>
                  </div>

                  <div class="form-row">
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="city" class="control-label">City</label>
                           <input name="city" type="text" class="form-control form-control-sm" value="{{ old('city') }}">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="province" class="control-label">Province/State</label>
                           <input name="province" type="text" class="form-control form-control-sm" value="{{ old('province') }}">
                        </div>                                    
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="postal_code" class="control-label">Postal/Zip Code</label>
                           <input name="postal_code" type="text" class="form-control form-control-sm" value="{{ old('postal_code') }}">
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
                           <label for="notes" class="control-label">Notes</label>
                           <textarea name="notes" class="form-control form-control-sm" rows="2">{{ old('notes') }} </textarea>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>
</div>
