@extends('layouts.app')
@section('title', 'TOP')

@section('content')
    <h1>POS</h1>
    POS番号 : {{ $pos_num }}<br /><br />

    << RECIPE >>
    <table>
        @foreach( $recipe_data as $data )
        <tr>
            <td>- {{ $data->name }}</td>
            <td>[{{ $data->price }}]</td>
        </tr>
        @endforeach
    </table>

    <br />
    
    << OPTION >>
    <table>
        @foreach( $option_data as $data )
        <tr>
            <td>- {{ $data->name }}</td>
            <td>[{{ $data->price }}]</td>
        </tr>
        @endforeach
    </table>
@endsection