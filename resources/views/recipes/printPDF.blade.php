<style>
    table {  font-family: arial, sans-serif;  border-collapse: collapse;  width: 100%;}
    td, th {  border: 1px solid #dddddd;  text-align: left;  padding: 8px;}
    tr:nth-child(even) {  background-color: #dddddd;}
</style>

<h2>Recipes List</h2>

@php
    $recipe_detail = $recipedata['recipe'];
    // dd($recipe_detail);
@endphp

<table>
    <tbody>
        <tr>
            <th>Id</th>
            <td>{{ $recipe_detail->id }}</td>
        </tr>
        <tr>
            <th>Title</th>
            <td>{{ $recipe_detail->title }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $recipe_detail->created_at }}</td>
        </tr>
    </tbody>
</table>
