@extends('layouts.app')
@section('title', 'BAR')
@section('subtitle', 'POS番号 : ' . $pos_num)

<script>
function selectChange( recipe_detail, material, recipe ) {
    recipe_id = parseInt(document.getElementById('recipe').value);
    recipe_area = document.getElementById('recipeArea');
    recipe_area.innerHTML = "<h3>" + seachRecipeName(recipe_id, recipe) + "</h3>";
    
    for( var i = 0; i < recipe_detail.length; i++ ){
        if( recipe_id == recipe_detail[i]['recipe_id'] ){
            recipe_area.innerHTML += "" + seachMaterialName( recipe_detail[i]['material_id'], material ) + " : " + recipe_detail[i]['quantity'] + "<br />";
            
        }
    }
}

function seachMaterialName( id, material ){
    for( var i = 0; i < material.length; i++ ){
        if( id == material[i]['id'] ){
            return material[i]['name'];
        }
    }
    return -1;
}

function seachRecipeName( id, recipe ){
    for( var i = 0; i < recipe.length; i++ ){
        if( id == recipe[i]['id'] ){
            return recipe[i]['name'];
        }
    }
    return -1;
}

</script>

@section('content')
    @php
    
    @endphp

    <h1><a href="/bar/{{ $pos_num }}">BAR</a> | RECIPE</h1>

    <hr>
    <select id="recipe" onChange="selectChange({{ $recipe_detail_data }}, {{ $material_data }}, {{ $recipe_data }})">
        @foreach( $recipe_data as $data )
        <option value="{{ $data->id }}">{{ $data->name }}</option>

        @endforeach
    </select>
    <hr>
    <div id="recipeArea">Recipe Area.</div>
    <hr>
@endsection