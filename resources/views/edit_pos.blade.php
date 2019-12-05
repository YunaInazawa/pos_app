@extends('layouts.app')
@section('title', 'EDIT_POS')
@section('subtitle', 'EDIT_POS')

@section('content')
    <h1>EDIT_POS</h1>

    <table>
        @foreach( $pos_data as $pos )
        <tr>
            <td>- {{ $pos->number }}</td>
            <td>[edit]</td>
            <td>[delete]</td>
        </tr>
        @endforeach
    </table>
    [+ 追加]
@endsection