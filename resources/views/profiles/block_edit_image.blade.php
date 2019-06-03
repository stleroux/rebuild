{{-- <div class="col-md-3"> --}}
                        <div class="card mb-2">
                           <div class="card-header card_header_2">Profile Image</div>
                           <div class="card-body card_body">
                              <div class="form-row">
                                 <div class="col text-center">
                                    @if ($user->profile->image)
                                       {{ Html::image("_profiles/" . $user->profile->image, "",array('height'=>'115','width'=>'115')) }}
                                    @else
                                       {{ Html::image("_profiles/no_photo.jpg", "", array('height'=>'100','width'=>'100')) }}
                                    @endif
                                 </div>
                              </div>
                              <div class="form-row">
                                 <div class="col">
                                    <div class="input-group py-3">
                                       <label class="btn btn-sm btn-block btn-primary" for="image">
                                          <input id="image" name="image" type="file" style="display:none" 
                                             onchange="$('#upload-file-info').html(this.files[0].name)">
                                          @if(!$user->profile->image)
                                             Select Image
                                          @else
                                             Change Image
                                          @endif
                                       </label>
                                       <span class='label label-info' id="upload-file-info"></span>
                                       @if($user->profile->image)
                                          <a href="{{ route('profile.deleteImage', $user->profile->id) }}" class="btn btn-sm btn-block btn-danger">Delete Image</a>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     {{-- </div> --}}