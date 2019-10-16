<table id="datatable" class="table table-hover table-sm searchHighlight">
   <thead>
      <tr>
         <th><input type="checkbox" id="selectall" class="checked" /></th>
         {{-- Add columns for search purposes only --}}
         <th class="d-none">English</th>
         <th class="d-none">French</th>
         {{-- Add columns for search purposes only --}}

         <th><div>Title</div></th>
         <th class="">Category</th>
         @if(last(request()->segments()) === 'articles')
            <th class="">Views</th>
         @endif
         <th class="">Author</th>
         <th class="">Created On</th>
         @if(last(request()->segments()) === 'trashed')
            <th class="">Deleted On</th>
         @endif
      </tr>
   </thead>
   <tbody>
      @foreach ($articles as $article)
         <tr>
            <td>
               <input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$article->id}}" class="check-all">
            </td>
            {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
            <td class="d-none">{{ $article->description_eng }}</td>
            <td class="d-none">{{ $article->description_fre }}</td>
            {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
            
            <td><a href="{{ route('admin.articles.showTrashed', $article->id) }}" class="">{{ $article->title }}</a></td>
            <td class="">{{ $article->category->name }}</td>
            @if(last(request()->segments()) === 'articles')
               <td class="">{{ $article->views }}</td>
            @endif
            <td class="">@include('common.authorFormat', ['model'=>$article, 'field'=>'user'])</td>
            <td class="">@include('common.dateFormat', ['model'=>$article, 'field'=>'created_at'])</td>
            @if(last(request()->segments()) === 'trashed')
               <td class="">@include('common.dateFormat', ['model'=>$article, 'field'=>'deleted_at'])</td>
            @endif
         </tr>
      @endforeach
   </tbody>
</table>
