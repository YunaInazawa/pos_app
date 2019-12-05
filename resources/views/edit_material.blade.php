@extends('layouts.app')
@section('title', 'EDIT_MATERIAL')
@section('subtitle', $message)

@section('content')
    <h1>{{ $message }}</h1>
        
    <table>
        @foreach( $mate_data as $data )
        <tr>
            <td>- {{ $data->name }}</td>
            <td>[edit]</td>
            <td>[delete]</td>
        </tr>
        @endforeach
    </table>
    [+ 追加]
@endsection