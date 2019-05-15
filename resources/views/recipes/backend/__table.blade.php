<table id="datatable" class="table table-sm table-hover">
   <thead>
      <tr>
          <th><input type="checkbox" id="selectall" class="checked" /></th>
         <th>Name</th>
         <th>Category</th>
         <th>Views</th>
         <th>Author</th>
         <th>Created On</th>
         <th>Publish(ed) On</th>
         <th data-orderable="false"></th>
      </tr>
   </thead>
   <tbody>
      @foreach($recipes as $recipe)
      <tr>
         <td>
            <input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$recipe->id}}" class="check-all">
         </td>
         <td><a href="{{ route('recipes.show', $recipe->id) }}">{{ ucwords($recipe->title) }}</a></td>
         <td>{{ ucwords($recipe->category->name) }}</td>
         <td>{{ $recipe->views }}</td>
         <td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td>
         <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
         <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at'])</td>
         <td class="text-right">
            {!! Form::open(['method'=>'DELETE', 'route'=>['recipes.trashDestroy',$recipe->id]]) !!}
               @include('common.buttons.edit', ['model'=>'recipe', 'id'=>$recipe->id, 'type'=>''])
               @include('common.buttons.restore', ['model'=>'recipe', 'id'=>$recipe->id])
               @if(\Request::is('*/trashed'))
                  @include('common.buttons.delete', ['model'=>'recipe', 'id'=>$recipe->id, 'type'=>''])
               @else
                  @include('common.buttons.trash', ['model'=>'recipe', 'id'=>$recipe->id, 'type'=>''])
               @endif
            {!! Form::close() !!}
         </td>
      </tr>
      @endforeach
   </tbody>
</table>