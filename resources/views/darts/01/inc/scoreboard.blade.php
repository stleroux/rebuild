<table id="tbl" class="table table-sm text-center bg-info table-bordered">

	@for ($i = 0; $i < 20; $i++)
      <colgroup></colgroup>
   @endfor

	<thead>
      <tr>
         <th></th>
         @for ($i = 1; $i < 21; $i++)
            <th class="text-center">{{ $i }}</th>
         @endfor
         <th></th>
      </tr>
	</thead>

	<tbody>
		<tr>
         <th>Single</th>
         @for ($i = 1; $i < 21; $i++)
            <td class="rowcolSelected"
               onmouseover="changeImage('{{ asset('_darts/' .$i . '.jpg') }}')"
               onmouseout="changeBack('{{ asset('_darts/0.jpg') }}')">{{ $i }}</td>
         @endfor
			<td class="rowcolSelected"
            onmouseover="changeImage('{{ asset('_darts/bull.jpg') }}')"
            onmouseout="changeBack('{{ asset('_darts/0.jpg') }}')">Bull</td>
      </tr>

		<tr>
			<th>Double</th>
         @for ($i = 1; $i < 21; $i++)
            <td class="rowcolSelected"
               onmouseover="changeImage('{{ asset('_darts/d' .$i . '.jpg') }}')"
               onmouseout="changeBack('{{ asset('_darts/0.jpg') }}')">{{ ($i * 2) }}</td>
         @endfor
			<td class="rowcolSelected"
            onmouseover="changeImage('{{ asset('_darts/dbull.jpg') }}')"
            onmouseout="changeBack('{{ asset('_darts/0.jpg') }}')">2x Bull</td>
		</tr>

		<tr>
			<th>Triple</th>
         @for ($i = 1; $i < 21; $i++)
            <td class="rowcolSelected"
               onmouseover="changeImage('{{ asset('_darts/t' .$i . '.jpg') }}')"
               onmouseout="changeBack('{{ asset('_darts/0.jpg') }}')">{{ ($i * 3) }}</td>
         @endfor
			<td></td>
		</tr>
	</tbody>
</table>
