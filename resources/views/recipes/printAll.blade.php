@extends ('layouts.print')

@section ('title', 'Print Recipe')

@section ('stylesheets')
   {{ Html::style('css/print.css') }}
@stop

@section ('content')

@foreach($recipes as $recipe)
   <div class="card mb-3 mt-5" style="page-break-after: always">
      
      <div class="card-header">
         <span class="h3">{{ ucwords($recipe->title) }}</span>
         @if($loop->first)
            <span class="float-right">
               <div class="btn-group">
                  {{-- @include('recipes.buttons.back', ['size'=>'sm', 'label'=>'']) --}}
                  @include('recipes.buttons.back', ['size'=>'xs', 'btn_label'=>'Back'])
                  @include('recipes.buttons.print2', ['size'=>'xs', 'btn_label'=>'Print'])
               </div>
            </span>
         @endif
      </div>
      
      <div class="card-body">
         <div class="row">
            <div class="col-xs-12 col-sm-8">
               <div class="card mb-2">
                  <div class="card-header">Ingredients</div>
                  <div class="card-body">
                     {!! $ingredients = str_replace(array('<p>','</p>'),array('','<br />'),$recipe->ingredients) !!}<br />
                  </div>
               </div>
            </div>
            <div class="col-xs-12 col-sm-4">
               <div class="card mb-2">
                  <div class="card-header card_header_2">Image</div>
                  <div class="card-body text text-center p-0 m-0">
                     @if($recipe->image)
                        <img src="/_recipes/{{ $recipe->image }}" alt="" height="200px" width="auto" class="card-img">
                     @else
                        <img src="/_recipes/image_not_available.jpg" alt="" height="200px" width="auto" class="card-img">
                     @endif
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-sm-8">
               <div class="card mb-2">
                  <div class="card-header">Methodology</div>
                  <div class="card-body">{!! $recipe->methodology !!}</div>
               </div>
               <div class="card" style="margin-bottom: 0px">
                  <div class="card-header">Notes</div>
                  <div class="card-body">
                     @if ($recipe->public_notes) 
                        {!! $recipe->public_notes !!}
                     @else
                        N/A
                     @endif
                  </div>
               </div>
            </div>
            <div class="col-xs-12 col-sm-4">
               <div class="card mb-2">
                  <div class="card-header">Information</div>
                  <div class="card-body">
                     <table width="100%">
                        <tr>
                           <th>Category</th>
                           <td>{{ ucwords($recipe->category->name) }}</td>
                        </tr>
                        <tr>
                           <th>Servings</th>
                           <td>{{ $recipe->servings }}</td>
                        </tr>
                        <tr>
                           <th>Prep Time</th>
                           <td>{{ $recipe->prep_time }} minutes</td>
                        </tr>
                        <tr>
                           <th>Cook Time</th>
                           <td>{{ $recipe->cook_time }} minutes</td>
                        </tr>
                        <tr>
                           <th>Created By</th>
                           <td>{{ $recipe->user->first_name }} {{ $recipe->user->last_name }}</td>
                        </tr>
                        <tr>
                           <th>Created On</th>
      
                           <td>
                              {{-- @include('recipes.dateFormat', ['dateFormat'=>Auth::user()->dateFormat, 'model'=>$recipe, 'field'=>'created_at']) --}}
                              {{-- @include('recipes.dateFormat', ['model'=>$recipe, 'field'=>'created_at']) --}}
                           </td>
                        </tr>
                        <tr>
                           <th>Source</th>
                           <td>
                              @if ($recipe->source)
                                 {{ $recipe->source }}
                              @else
                                 N/A
                              @endif
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="panel-footer">
         From the Recipe Book at TheWoodBarn.ca
      </div>
   </div>
@endforeach

@stop
