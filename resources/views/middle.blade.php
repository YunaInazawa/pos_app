@extends('layouts.app')
@section('title', 'MIDDLE')
@section('subtitle', 'MIDDLE')

<!-- javascript -->
<script>

</script>

@section('content')
    @php
    $now_number = 0;
    $data = $order_detail_data;
    @endphp

    <h1>MIDDLE</h1>

    @for( $i = 0; $i < count($data); $i++ )
    @if( $now_number != $data[$i]->order_id )
    <hr>
    <div id="order_num" class="order-num-box">
        <h1>　{{ $data[$i]->order_id }}.</h1>
    </div>
    <div id="order_recipe" class="order-box">
    @php
    $now_number = $data[$i]->order_id
    @endphp
    @endif

        <b>< {{ $data[$i]->recipe->name }} : {{ $data[$i]->drink_num }} ></b><br />
        <div class="detail">-> detail</div><div class="quantity">: quan</div>
        <div class="floatclear"></div>

    @if( $i == count($data) - 1 || $now_number != $data[$i + 1]->order_id )
    </div>
    <div id="order_option" class="order-box">
        <b>< OPTIONs ></b><br />
        option.<br />
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