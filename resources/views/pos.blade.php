@extends('layouts.app_right')
@section('title', 'POS')
@section('subtitle', 'POS番号 : ' . $pos_num)

<!-- javascript -->
<script>
    var orders = [];
    var options = [];

    function addOrder( recipe, price ) {
        if( checkFirstOrder(recipe) ) {
            var num = orders.push([recipe, price, 1]) - 1;

            var input = "<input type='number' id='" +orders[num][0] + "' value='1' min='0' max='2' onchange='changeOrder()' style='width: 3em;'> "
            document.getElementById('order-panel').insertAdjacentHTML('beforeend', input + orders[num] + "<br />");

            changeOrder()
        }
    }

    function addOption( option, price ) {
        if( checkFirstOption(option) ) {
            var num = options.push([option, price, 1]) - 1;

            var input = "<input type='number' id='" +options[num][0] + "' size='1' value='1' min='0' max='1' onchange='changeOrder()' style='width: 3em;'> "
            document.getElementById('option-panel').insertAdjacentHTML('beforeend', input + options[num] + "<br />");

            changeOrder()
        }
    }

    function changeOrder() {
        var total = 0;

        for( var i = 0; i < orders.length; i++ ){
            orders[i][2] = document.getElementById(orders[i][0]).value;
            total += parseInt(orders[i][1]) * parseInt(orders[i][2]);
        }

        for( var i = 0; i < options.length; i++ ){
            options[i][2] = document.getElementById(options[i][0]).value;
            total += parseInt(options[i][1]) * parseInt(options[i][2]);
        }

        document.getElementById('total').innerHTML = total;
        
    }

    function changePay() {
        var total = $("#total").text();
        var pay  = document.getElementById('pay').value;
        
        document.getElementById('change').innerHTML = pay - total;
    }

    function checkFirstOrder( value ) {
        for( var i = 0; i < orders.length; i++ ) {
            if( orders[i][0] == value ) {
                return false;
            }
        }
        return true;
    }

    function checkFirstOption( value ) {
        for( var i = 0; i < options.length; i++ ) {
            if( options[i][0] == value ) {
                return false;
            }
        }
        return true;
    }

    function check(){
        var total = "合計：" + $("#total").text() + "円\n";
        var pay  = "お預かり：" + document.getElementById('pay').value + "円\n";
        var change = "おつり：" + $("#change").text() + "円\n\n";
        var recipe_name_data = joinArray(orders, 0);
        var recipe_num_data = joinArray(orders, 2);

        if(confirm(total + pay + change + 'OK?')){
            document.getElementById('hi').innerHTML += "<input type='hidden' name='recipe_name' value='" + recipe_name_data + "'>";
            document.getElementById('hi').innerHTML += "<input type='hidden' name='recipe_num' value='" + recipe_num_data + "'>";
            return true;
        }
        return false;
    }

    function joinArray( arr, num ){
        var result = "";
        for( var i = 0; i < arr.length; i++ ){
            result += arr[i][num] + ",";
        }
        result = result.substring(0, result.length - 1);

        return result;

    }
</script>

<!-- HTML -->
@section('content')
    <div><h1><< RECIPE >></h1></div>

    @foreach( $recipe_data as $data )
    <div class="fl" style="width: 280px; height: 150px;" onclick="addOrder('{{ $data->name }}', '{{ $data->price }}')">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $data->name }}</h4>
                <h6 class="card-subtitle mb-2 text-muted">￥{{ $data->price }}</h6>
                <p class="card-text">Recipe.</p>
            </div>
        </div>
    </div>
    @endforeach

    <div class="floatclear"></div>

    <br />

    <div><h1><< OPTION >></h1></div>
    @foreach( $option_data as $data )
    <div class="fl" style="width: 280px; height: 150px;" onclick="addOption('{{ $data->name }}', '{{ $data->price }}')">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $data->name }}</h4>
                <h6 class="card-subtitle mb-2 text-muted">￥{{ $data->price }}</h6>
                <p class="card-text">Recipe.</p>
            </div>
        </div>
    </div>
    @endforeach

    <div class="floatclear"></div>
@endsection

@section('sidemenu')
    <form action="{{ route('pos.new') }}" method="POST" onSubmit="return check()">
        @csrf
        <div id="order-panel" style="height: 200px;">
        << ORDER >><br />
            
        </div>

        <hr>

        <div id="option-panel" style="height: 200px;">
        << OPTION >><br />
            
        </div>

        <div id="other-panel">
            備考<br />
            <textarea name="other" rows="4" cols="25"></textarea>
        </div>

        <hr>

        <div id="money-panel" style="font-size: 20px;">
                <b>
                合計　　 ￥<span id="total">0</span><br />
                お預かり ￥<input type="number" id="pay" value="0" min="0" step="10" style="width: 4em;" onchange="changePay()"><br />
                ----------------------------<br />
                おつり　 ￥<span id="change">0</span><br />
                </b>
                <br />
                <input type="submit" value="OK">
        </div>

        <input type="hidden" name="pos_num" value="{{ $pos_num }}">
        <div id="hi"></div>
    </form>
@endsection
