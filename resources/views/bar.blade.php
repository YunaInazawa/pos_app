@extends('layouts.app')
@section('title', 'BAR')
@section('subtitle', 'POS番号 : ' . $pos_num)

@section('content')
    <h1>BAR</h1>
    {{ $pos_num }}
@endsection