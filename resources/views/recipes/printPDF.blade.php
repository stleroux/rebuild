{{-- <style>
    table {  font-family: arial, sans-serif;  border-collapse: collapse;  width: 100%;}
    td, th {  border: 1px solid #dddddd;  text-align: left;  padding: 8px;}
    tr:nth-child(even) {  background-color: #dddddd;}
</style> --}}

@php
    $recipe_detail = $recipedata['recipe'];
@endphp

<table width="100%" border="0">
    <thead>
        <tr>
            <th colspan="2" style="background-color: lightgrey; border: 1px solid black" align="center">
                <h2>{{ ucwords($recipe_detail->title) }}</h2>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th width="75%" style="border: 1px solid black">Ingredients</th>
            <th style="border: 1px solid black">Image</th>
        </tr>
        <tr>
            <td width="75%" valign="top">{!! $ingredients = str_replace(array('<p>','</p>'),array('','<br />'),$recipe_detail->ingredients) !!}</td>
            <td>
                @if($recipe_detail->image)
                    <img src="_recipes/{{ $recipe_detail->image }}" alt="" height="200px" width="auto" class="card-img">
                @else
                    <img src="_recipes/image_not_available.jpg" alt="" height="200px" width="auto" class="card-img">
                @endif
            </td>
        </tr>

        <tr>
            <td cospan="2">&nbsp;</td>
        </tr>
        
        <tr>
            <th colspan="2" style="border: 1px solid black">Methodology</th>
        </tr>
        <tr>
            <td colspan="2">
                {!! $methodology = str_replace(array('<p>','</p>'),array('','<br />'),$recipe_detail->methodology) !!}
            </td>
        </tr>

        <tr>
            <td cospan="2">&nbsp;</td>
        </tr>

        <tr>
            <th colspan="2" style="border: 1px solid black">Notes</th>
        </tr>
        <tr>
            <td colspan="2">
                @if ($recipe_detail->public_notes) 
                    {!! $recipe_detail->public_notes !!}
                @else
                    N/A
                @endif
            </td>
        </tr>
        
        <tr>
            <td cospan="2">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2">
                <table width="100%" border="1" cellspacing="0" cellpadding="1">
                    <tr>
                        <th width="25%">Category</th>
                        <td>{{ ucwords($recipe_detail->category->name) }}</td>
                    </tr>
                    <tr>
                        <th>Servings</th>
                        <td>{{ $recipe_detail->servings }}</td>
                    </tr>
                    <tr>
                        <th>Prep Time</th>
                        <td>{{ $recipe_detail->prep_time }} minutes</td>
                    </tr>
                    <tr>
                        <th>Cook Time</th>
                        <td>{{ $recipe_detail->cook_time }} minutes</td>
                    </tr>
                    <tr>
                        <th>Created By</th>
                        <td>{{ $recipe_detail->user->first_name }} {{ $recipe_detail->user->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Created On</th>
                        <td>{{ $recipe_detail->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Source</th>
                        <td>
                            @if ($recipe_detail->source)
                                {{ $recipe_detail->source }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2">From the Recipe Book at TheWoodBarn.ca</td>
        </tr>
    </tbody>
    
</table>
