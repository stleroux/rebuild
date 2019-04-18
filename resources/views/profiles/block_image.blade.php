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
   </div>
</div>
