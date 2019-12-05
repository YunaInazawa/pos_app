@extends('layouts.app')
@section('title', 'EDIT')
@section('subtitle', 'EDIT')

@section('content')
    <h1>EDIT</h1>

    <a href="{{route('edit.mate')}}">材料</a><br />
    <a href="{{route('edit.recipe')}}">レシピ</a><br />
    <a href="#">売上</a><br /><br />

    <a href="{{route('edit.pos')}}">POS</a><br />
@endsection