@extends('layouts.app')
@section('title', 'TOP')

@section('content')
    <h1>TOP</h1>
    <form action="{{ route('check') }}" method="POST">
        @csrf
        <select name="pos_num">

            <option value="101">101</option>
            <option value="102">102</option>
            <option value="201">201</option>
            <option value="202">202</option>
            <option value="203">203</option>
        </select>
        <input type="submit" name="pos_btn" value="レジ"><br />
    </form>

    <input type="button" name="middle_btn" value="中間" onclick=location.href="{{ route('middle') }}"><br />

    <input type="button" name="edit_btn" value="編集" onclick=location.href="{{ route('edit') }}"><br />
    
@endsection