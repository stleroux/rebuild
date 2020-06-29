<div class="card mb-2">
   <div class="card-body section_body p-2">
      
      <div class="form-row">
         <div class="col-9">
            {{-- Account Info --}}
            <div class="card mb-2">
               <div class="card-header card_header p-2">Account Info</div>
               <div class="card-body section_body p-2">
                  <div class="form-row">
                     {{-- <div class="col-md-3"> --}}
                        <div class="col-md-2">
                           <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                              <label for="username" class="required">Username</label>
                              <input name="username" type="text" class="form-control form-control-sm" value="{{ $user->username }}">
                              <span class="bg-danger text-dark">{{ $errors->first('username') }}</span>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="created_at">Member Since</label>
                              @if($user->created_at)
                                 <input type="text" class="form-control form-control-sm" value="{{ $user->created_at }}" disabled>
                              @else
                                 <input type="text" class="form-control form-control-sm" value="Unknown" disabled>
                              @endif
                           </div>
                        </div>
                        <div class="col-md-3 col-lg-2">
                           <div class="form-group">
                              <label for="last_login_date">Last Login Date</label>
                              <input type="text" class="form-control form-control-sm" value="{{ $user->last_login_date }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="login_count">Login Count</label>
                              <input type="text" class="form-control form-control-sm" value="{{ $user->login_count }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Total Perms</label>
                              <input type="text" class="form-control form-control-sm" value="{{ $user->permissions->count() }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="approved">Approved</label>
                              {{-- <i class="far fa-question-circle float-right" data-toggle="tooltip" data-placement="top" title=""></i> --}}
                              {{ Form::select('approved', ['No','Yes'], $user->approved, ['class'=>'form-control form-control-sm']) }}
                           </div>
                        </div>
                        {{-- <div class="col-md-2">
                           <div class="form-group">
                              <label for="status">Invoicer Client</label>
                              <select name="invoicer_client" id="invoicer_client" class="form-control form-control-sm">
                                 @foreach($user->invoicerclientOptions() as $invoicerclientOptionKey => $invoicerclientOptionValue)
                                    <option value="{{$invoicerclientOptionKey}}" {{ $user->invoicer_client == $invoicerclientOptionValue ? 'selected' : '' }}>{{ $invoicerclientOptionValue }}</option>
                                 @endforeach
                              </select>
                              <div class="text-danger">{{ $errors->first('invoicer_client') }}</div>
                           </div>
                        </div> --}}
                     {{-- </div> --}}
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
                           <input name="first_name" type="input-text" class="form-control form-control-sm" value="{{ $user->first_name }}">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="last_name">Last Name</label>
                           <input name="last_name" type="text" class="form-control form-control-sm" value="{{ $user->last_name }}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                           <label for="email" class="required">Email Address</label>
                           <input name="email" type="text" class="form-control form-control-sm" value="{{ $user->email }}">
                           <span class="bg-danger text-dark">{{ $errors->first('email') }}</span>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="public_email">Public Email</label>
                           <i class="far fa-question-circle float-right" data-toggle="tooltip" data-placement="top" title="Do you want to show your email address to all users?"></i>
                           {{ Form::select('public_email', ['No','Yes'], $user->public_email, ['class'=>'form-control form-control-sm']) }}
                        </div>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="telephone">Telephone</label>
                           <input name="telephone" type="text" class="form-control form-control-sm" value="{{ $user->telephone }}">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="cell">Cell Phone</label>
                           <input name="cell" type="text" class="form-control form-control-sm" value="{{ $user->cell }}">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="fax">Fax</label>
                           <input name="fax" type="text" class="form-control form-control-sm" value="{{ $user->fax }}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="website">Website</label>
                           <input name="website" type="text" class="form-control form-control-sm" value="{{ $user->website }}">
                        </div>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="company_name">Company Name</label>
                           <input name="company_name" type="text" class="form-control form-control-sm" value="{{ $user->company_name }}">
                           <span><small>Required for user to show up in the Invoicer</small></span>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="dart_doubleOut">Dart Double Out</label>
                           <select name="dart_doubleOut" class="form-control form-control-sm">
                              <option value="{{ $user->dart_doubleOut }}" selected="selected">{{ $user->dart_doubleOut }}</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15">15</option>
                              <option value="16">16</option>
                              <option value="17">17</option>
                              <option value="18">18</option>
                              <option value="19">19</option>
                              <option value="20">20</option>
                           </select>
                           <span><small>Preferred double out for Dart games</small></span>
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
                           <input name="civic_number" type="text" class="form-control form-control-sm" value="{{ $user->civic_number }}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="address_1" class="control-label">Address 1</label>
                           <input name="address_1" type="text" class="form-control form-control-sm" value="{{ $user->address_1 }}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="address_2" class="control-label">Address 2</label>
                           <input name="address_2" type="text" class="form-control form-control-sm" value="{{ $user->address_2 }}">
                        </div>
                     </div>
                  </div>

                  <div class="form-row">
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="city" class="control-label">City</label>
                           <input name="city" type="text" class="form-control form-control-sm" value="{{ $user->city }}">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="province" class="control-label">Province/State</label>
                           <input name="province" type="text" class="form-control form-control-sm" value="{{ $user->province }}">
                        </div>                                    
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="postal_code" class="control-label">Postal/Zip Code</label>
                           <input name="postal_code" type="text" class="form-control form-control-sm" value="{{ $user->postal_code }}">
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
                           <textarea name="notes" class="form-control form-control-sm" rows="2">{{ $user->notes }} </textarea>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>
</div>