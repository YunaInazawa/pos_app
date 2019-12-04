@extends('layouts.app')
@section('title', 'TOP')

@section('content')
    <h1>ADMIN</h1>

    <a href="{{route('edit.mate')}}">材料</a><br />
    <a href="{{route('edit.recipe')}}">レシピ</a><br />
    <a href="#">売上</a><br /><br />

    <a href="{{route('edit.pos')}}">POS</a><br />
@endsection