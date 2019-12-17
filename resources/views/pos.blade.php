@extends('layouts.app_right')
@section('title', 'POS')
@section('subtitle', 'POS番号 : ' . $pos_num)

<!-- javascript -->
<script>
    var orders = [];
    var options = [];

    /* orders 追加 */
    function addOrder( recipe, price ) {
        if( checkFirstOrder(recipe) ) {
            var num = orders.push([recipe, price, 1]) - 1;

            var input = "<input type='number' id='" +orders[num][0] + "' value='1' min='0' max='2' onchange='changeOrder()' style='width: 3em;'> "
            document.getElementById('order-panel').insertAdjacentHTML('beforeend', input + orders[num] + "<br />");

            changeOrder()
        }
    }

    /* options 追加 */
    function addOption( option, price ) {
        if( orders.length == 0 ){
            return;
        }

        //if( checkFirstOption(option) ) {
            var num = options.push([option, price, 1, 0]) - 1;

            var input = "<input type='number' id='" +options[num][0] + "' size='1' value='1' min='0' max='1' onchange='changeOrder()' onchange='changeOrder()' style='width: 3em;'> ";
            var input2 = "　　∟ <select name=" + options[num][0] + " id=" + options[num][0] + num +  ">";
            for( var i = 0; i < orders.length; i++ ){
                if( orders[i][2] != 0 ){
                    input2 += "<option value=" + orders[i][0] + ">" + orders[i][0] + "</option>";
                }
            }
            input2 += "</select>";

            document.getElementById('option-panel').insertAdjacentHTML('beforeend', input + options[num] + "<br />" + input2 + "<br />");

            changeOrder()
        //}
    }

    /* 変更時発火 */
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

        for( var i = 0; i < options.length; i++ ){
            if( options[i][2] != 0 ){
                var optionRecipe = document.getElementById(options[i][0] + i);
                options[i][3] = optionRecipe.value;
                removeChildren(optionRecipe);
                addChildren(optionRecipe);
                optionRecipe.value = options[i][3];
            }
        }
        

        document.getElementById('total').innerHTML = total;
        
    }

    function removeChildren( sel ){
        if( sel.hasChildNodes() ){
            while( sel.childNodes.length > 0 ){
                sel.removeChild(sel.firstChild);
            }
        }
    }

    function addChildren( sel ){
        for(var i = 0; i < orders.length; i++){
            if( orders[i][2] != 0 ){
                // option要素を生成
                var option = document.createElement('option');
                option.text = orders[i][0];
                option.value = orders[i][0];
                sel.appendChild(option);
            }
        }
    }

    /* 「お預かり」変更時発火 */
    function changePay() {
        var total = $("#total").text();
        var pay  = document.getElementById('pay').value;
        
        document.getElementById('change').innerHTML = pay - total;
    }

    /* orders 存在チェック */
    function checkFirstOrder( value ) {
        for( var i = 0; i < orders.length; i++ ) {
            if( orders[i][0] == value ) {
                return false;
            }
        }
        return true;
    }

    /* options 存在チェック */
    function checkFirstOption( value ) {
        for( var i = 0; i < options.length; i++ ) {
            if( options[i][0] == value ) {
                return false;
            }
        }
        return true;
    }

    /* 「OK」クリック時 */
    function check(){
        changeOrder()
        changePay();
        var total = parseInt($("#total").text());
        var pay  = parseInt(document.getElementById('pay').value);
        var change = pay - total;

        if( change < 0 ){
            alert("ERROR : " + Math.abs(change) + "円不足");
            return false;
        }

        var recipe_name_data = joinArray(orders, 0);
        var recipe_num_data = joinArray(orders, 2);
        var option_name_data = joinArray(options, 0);
        var option_num_data = joinArray(options, 2);
        var option_recipe = joinArray(options, 3);

        var str_total = "合計：" + total + "円\n";
        var str_pay  = "お預かり：" + pay + "円\n";
        var str_change = "おつり：" + change + "円\n\n";
        // alert(recipe_name_data);
        // alert(recipe_num_data);
        // alert(option_name_data);
        // alert(option_num_data);
        // alert(option_recipe_num);

        if(confirm(str_total + str_pay + str_change + 'OK?')){
            document.getElementById('hi').innerHTML += "<input type='hidden' name='recipe_name' value='" + recipe_name_data + "'>";
            document.getElementById('hi').innerHTML += "<input type='hidden' name='recipe_num' value='" + recipe_num_data + "'>";
            document.getElementById('hi').innerHTML += "<input type='hidden' name='option_name' value='" + option_name_data + "'>";
            document.getElementById('hi').innerHTML += "<input type='hidden' name='option_num' value='" + option_num_data + "'>";
            document.getElementById('hi').innerHTML += "<input type='hidden' name='option_recipe' value='" + option_recipe + "'>";
            return true;
        }
        return false;
    }

    /* 配列連結 */
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
    @if(Session::has('message'))
        <h4>登録したお客様番号：{{ session('message') }}</h4>
    @endif

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
