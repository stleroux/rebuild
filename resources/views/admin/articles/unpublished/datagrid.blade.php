<table id="datatable" class="table table-hover table-sm searchHighlight">
   <thead>
      <tr>
         <th><input type="checkbox" id="selectall" class="checked" /></th>
         {{-- Add columns for search purposes only --}}
         <th class="d-none">English</th>
         <th class="d-none">French</th>
         {{-- Add columns for search purposes only --}}

         <th><div>Title</div></th>
         <th class="hidden-xs">Category</th>
         <th class="hidden-xs hidden-sm">Views</th>
         <th class="hidden-xs">Author</th>
         <th class="hidden-sm hidden-xs">Created On</th>
         <th></th>
      </tr>
   </thead>
   <tbody>
      @foreach ($articles as $key => $article)
         <tr>
            <td>
               <input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$article->id}}" class="check-all">
            </td>
            {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
            <td class="d-none">{{ $article->description_eng }}</td>
            <td class="d-none">{{ $article->description_fre }}</td>
            {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
            
            <td><a href="{{ route('admin.articles.show', $article->id) }}" class="">{{ $article->title }}</a></td>
            <td class="hidden-xs">{{ $article->category->name }}</td>
            <td class="hidden-xs hidden-sm">{{ $article->views }}</td>
            <td class="hidden-xs">@include('common.authorFormat', ['model'=>$article, 'field'=>'user'])</td>
            <td class="hidden-sm hidden-xs">@include('common.dateFormat', ['model'=>$article, 'field'=>'created_at'])</td>
            <td>
               @include('admin.articles.buttons.edit', ['size'=>'xs'])
            </td>
         </tr>
      @endforeach
   </tbody>
</table>