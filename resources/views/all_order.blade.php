@extends('layouts.app')
@section('title', 'ALL_ORDER')
@section('subtitle', 'ALL_ORDER')

@section('content')
    @php
    $now_number = 0;
    $data = $order_detail_data;
    $temp = '';
    @endphp

    <h1><a href="{{ route('middle') }}">MIDDLE</a> | ALL_ORDER</h1>

    @for( $i = 0; $i < count($data); $i++ )
        <div id="hi{{ $data[$i]->order_id }}"></div>
        @csrf
        @if( $now_number != $data[$i]->order_id )
        <hr>
        <div id="order_num" class="order-num-box center">
            <h1>{{ $data[$i]->order_id }}.</h1>
            <p>{{ $data[$i]->order->end_flag ? "完了済" : "" }}</p>
        </div>
        <div id="order_recipe" class="order-box">
        @php
        $now_number = $data[$i]->order_id
        @endphp
        @endif

            <b>< {{ $data[$i]->recipe->name }} : {{ $data[$i]->drink_num }} ></b><br />

            @for( $j = 0; $j < count($recipe_detail_data[$data[$i]->recipe->name]); $j++ )
            <div class="detail">　- {{ $recipe_detail_data[$data[$i]->recipe->name][$j][0] }}</div>
            <div class="quantity">: {{ $recipe_detail_data[$data[$i]->recipe->name][$j][1] }}</div>
            <div class="floatclear"></div>
            @endfor

        @if( $i == count($data) - 1 || $now_number != $data[$i + 1]->order_id )
        </div>

        <div id="order_option" class="order-box">
            <b>< OPTIONs ></b><br />
            @foreach( $option_data as $option )
            @if( $option->order_detail->order_id == $data[$i]->order_id )
            @if( $temp != $option->order_detail->id )
            @php
            $temp = $option->order_detail->id;
            @endphp
            - {{ $option->order_detail->recipe->name }}<br />
            @endif
            　{{ $option->option->name }}<br />
            @endif
            @endforeach
        </div>

        <div id="order_other" class="order-box">
            <b>< OTHERs ></b><br />
            {{ $data[$i]->order->other }} <br />
        </div>
        <div class="floatclear"></div>
        @endif
    @endfor

    <hr>
@endsection