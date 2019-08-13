@extends('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop    

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('blocks.member')
   @include('profiles.block_contributions')
@endsection

@section('content')

   <div class="card mb-3">

      <div class="card-header section_header p-2">
         Show Profile
         <span class="float-right">
            {{-- @include('projects.addins.links.help', ['size'=>'xs', 'bookmark'=>'projects']) --}}
            {{-- @include('users.buttons.back', ['size'=>'xs']) --}}
            @if($user->id === Auth::user()->id)
               <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-xs btn-primary">
                  <i class="fa fa-edit"></i>
                  Edit Profile
               </a>
            @endif
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
                        {{-- <div class="col-md-3"> --}}
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label for="username">Username</label>
                                 <input name="username" type="text" class="form-control form-control-sm" value="{{ $user->username }}" disabled>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label for="created_at">Member Since</label>
                                 @if($user->created_at)
                                    <input type="text" class="form-control form-control-sm" value="{{ $user->created_at->format('M d, Y') }}" disabled>
                                 @else
                                    <input type="text" class="form-control form-control-sm" value="Unknown" disabled>
                                 @endif
                              </div>
                           </div>
                           <div class="col-md-3 col-lg-2">
                              <div class="form-group">
                                 <label for="last_login_date">Last Login Date</label>
                                 <input type="text" class="form-control form-control-sm" value="{{ $user->last_login_date->format('M d, Y') }}" disabled>
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
                                 <label>Total permissions</label>
                                 <input type="text" class="form-control form-control-sm" value="{{ $user->permissions->count() }}" disabled>
                              </div>
                           </div>
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
                              <label for="first_name" class="required">First Name</label>
                              <input name="first_name" type="input-text" class="form-control form-control-sm" value="{{ $user->first_name }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="last_name" class="required">Last Name</label>
                              <input name="last_name" type="text" class="form-control form-control-sm" value="{{ $user->last_name }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email" class="required">Email Address</label>
                              <input name="email" type="text" class="form-control form-control-sm" value="{{ $user->email }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="public_email">Public Email</label>
                              <i class="far fa-question-circle float-right" data-toggle="tooltip" data-placement="top" title="Do you want to show your email address to all users?"></i>
                              {{ Form::select('public_email', ['No','Yes'], $user->public_email, ['class'=>'form-control form-control-sm', 'disabled'] ) }}
                           </div>
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="telephone">Telephone</label>
                              <input name="telephone" type="text" class="form-control form-control-sm" value="{{ $user->telephone }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="cell">Cell Phone</label>
                              <input name="cell" type="text" class="form-control form-control-sm" value="{{ $user->cell }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fax">Fax</label>
                              <input name="fax" type="text" class="form-control form-control-sm" value="{{ $user->fax }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="website">Website</label>
                              <input name="website" type="text" class="form-control form-control-sm" value="{{ $user->website }}" disabled>
                           </div>
                        </div>
                     </div>
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
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="civic_number" class="control-label">Civic/Unit N<sup>o</sup></label>
                              <input name="civic_number" type="text" class="form-control form-control-sm" value="{{ $user->civic_number }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="address_1" class="control-label">Address 1</label>
                              <input name="address_1" type="text" class="form-control form-control-sm" value="{{ $user->address_1 }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="address_2" class="control-label">Address 2</label>
                              <input name="address_2" type="text" class="form-control form-control-sm" value="{{ $user->address_2 }}" disabled>
                           </div>
                        </div>
                     </div>

                     <div class="form-row">
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="city" class="control-label">City</label>
                              <input name="city" type="text" class="form-control form-control-sm" value="{{ $user->city }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="province" class="control-label">Province/State</label>
                              <input name="province" type="text" class="form-control form-control-sm" value="{{ $user->province }}" disabled>
                           </div>                                    
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="postal_code" class="control-label">Postal/Zip Code</label>
                              <input name="postal_code" type="text" class="form-control form-control-sm" value="{{ $user->postal_code }}" disabled>
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
                              <textarea name="notes" class="form-control form-control-sm" rows="2" disabled>{{ $user->notes }}</textarea>
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

