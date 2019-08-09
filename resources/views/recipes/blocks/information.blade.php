<div class="card mb-2">
   <div class="card-header block_header p-2">
   	<i class="fa fa-comment"></i>
      Information
   </div>
   <div class="list-group py-0 px-0">
   	<ul class="list-group">
			<table class="table table-sm table-hover" style="margin-bottom: 0px">
				<thead>
					<tr>
						<th>Created By</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-right">@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])
						</td>
					</tr>
				</tbody>
			</table>

			<table class="table table-sm table-hover" style="margin-bottom: 0px">
				<thead>
					<tr>
						<th>Created On</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-right">@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
					</tr>
				</tbody>
			</table>
			
			<table class="table table-sm table-hover" style="margin-bottom: 0px">
				@if ($recipe->modified_by_id)
					<tr>
						<th>Updated By</th>
					</tr>
					<tr>
						<td class="text-right">@include('common.authorFormat', ['model'=>$recipe, 'field'=>'modifiedBy'])
						</td>
					</tr>
					<tr>
						<th>Updated On</th>
					</tr>
					<tr>
						<td class="text-right">@include('common.dateFormat', ['model'=>$recipe, 'field'=>'updated_at'])
						</td>
					</tr>
				@endif

				@if ($recipe->last_viewed_by_id)
					<tr>
						<th>Last Viewed By</th>
					</tr>
					<tr>
						<td class="text-right">@include('common.authorFormat', ['model'=>$recipe, 'field'=>'lastViewedBy'])
						</td>
					</tr>
					<tr>
						<th>Last Viewed On</th>
					</tr>
					<tr>
						<td class="text-right">@include('common.dateFormat', ['model'=>$recipe, 'field'=>'last_viewed_on'])
						</td>
					</tr>
				@endif
			</table>
		</ul>
	</div>
</div>
