<table id="datatable" class="table table-hover table-sm searchHighlight">
	<thead>
		<tr>
			<th data-orderable="false"><input type="checkbox" id="selectall" class="checked" /></th>
			{{-- Add columns for search purposes only --}}
			<th class="d-none">English</th>
			<th class="d-none">French</th>
			{{-- Add columns for search purposes only --}}
			<th>Title</th>
			<th class="">Category</th>
			<th class="">Views</th>
			<th class="">Author</th>
			<th class="">Created On</th>
			<th class="">Publish(ed) On</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($articles as $key => $article)
			<tr>
				{{-- @if(checkACL('editor')) --}}
					<td>
						<input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$article->id}}" class="check-all">
					</td>
				{{-- @endif --}}
				{{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
				<td class="d-none">{{ $article->description_eng }}</td>
				<td class="d-none">{{ $article->description_fre }}</td>
				{{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
				
				<td><a href="{{ route('admin.articles.show', $article->id) }}" class="">{{ $article->title }}</a></td>
				<td class="">{{ $article->category->name }}</td>
				<td class="">{{ $article->views }}</td>
				<td class="">@include('common.authorFormat', ['model'=>$article, 'field'=>'user'])</td>
				<td class="">@include('common.dateFormat', ['model'=>$article, 'field'=>'created_at'])</td>
				<td class=" 
					{{ $article->published_at >= Carbon\Carbon::now() ? 'text text-warning' : '' }}
					{{ $article->published_at == null ? 'text text-info' : '' }}
				">
					@include('common.dateFormat', ['model'=>$article, 'field'=>'published_at'])
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
