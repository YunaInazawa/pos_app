@extends('layouts.app')
@section('title', 'TOP')
@section('subtitle', 'TOP')

<!--
    Controllerから送られたデータ
    /**
     * pos_data     : PosTable( id, number )
     **/
-->

@section('content')
    <h1>TOP</h1>
    <form action="{{ route('check') }}" method="POST">
        @csrf
        <select name="pos_num">
            @foreach( $pos_data as $pos )
            <option value="{{ $pos->number }}">{{ $pos->number }}</option>
            @endforeach
        </select>
        <input type="submit" name="pos_btn" value="レジ"><br />
    </form>

    <input type="button" name="middle_btn" value="中間" onclick=location.href="{{ route('middle') }}"><br />

    <input type="button" name="edit_btn" value="編集" onclick=location.href="{{ route('edit') }}"><br />
    
@endsection