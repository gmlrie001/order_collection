@if($order->coupon != null)
  <div class="col-12 applied-coupon">
      <a href="/remove/coupon/{{$order->id}}">
          {{$order->coupon}}
          <i class="fa fa-times"></i>
      </a>
  </div>

@else
  @if(sizeof($available_coupons))
    <div class="col-12 available-coupons">
        <h2>Available Coupon Codes</h2>
        @foreach($available_coupons as $available_coupon)
        <a href="/apply/coupon/{{$available_coupon->id}}">
            {{$available_coupon->code}}
            <i class="fa fa-plus"></i>
        </a>
        @endforeach
    </div>
  @endif

  <form action="/apply/coupon/code" method="post" class="col-12 p-0 promo-form">
      {!!Form::token()!!}
      <div class="input-group">
          <input type="text" class="form-control" placeholder="Enter Promo Code" name="code">
          <div class="input-group-append">
              <button type="submit">
                  GO
              </button>
          </div>
      </div>
  </form>
@endif

@if($user != null)
  @php
    $walletTotal = 0;

    foreach($user->creditItems as $creditItem){

      if($creditItem->credit_debit == 'credit'){
        $walletTotal += $creditItem->amount;

      }else{
        $walletTotal -= $creditItem->amount;
      }
    }

    if($walletTotal > $subTotal-$couponTotal){
      $walletTotal = $subTotal-$couponTotal;
    }
  @endphp

  @if($walletTotal > 0)

  <div class="col-12 available-coupons">
    <h2>Use Store Credit?</h2>
  </div>

  <div class="col-12 store-credit">
    <span>R 0</span>
      <div id="slider"></div>
    <span class="text-right">R {{number_format($walletTotal, 0, "", "")}}</span>

    <em class="decrease fa fa-chevron-left"
        style="float: left;display: block;width: 30px;height: 30px;text-align: center;line-height: 31px;margin-top: 15px;background: #161a60;color: #fff;font-style: normal;font-size: 14px;cursor: pointer;"></em>
    <em class="increase fa fa-chevron-right"
        style="float: left;display: block;width: 30px;height: 30px;text-align: center;line-height: 31px;margin-top: 15px;background: #161a60;color: #fff;font-style: normal;font-size: 14px;cursor: pointer;margin-left: 10px;text-indent: 3px;"></em>

    <i class="store-credit-value">Value: R {{number_format($creditTotal, 0, "", "")}}</i>
  </div>

  <div class="col-12 apply-store-credit">
    <span>APPLY</span>
  </div>

  <input type="text" name="store-credit-input" style="display:none;" id="amount" value="0">

  <script>
      $( function() {
        $( "#slider" ).slider({
          range: "max",

          min: 0,
          step: 1, 

          max: {{number_format($walletTotal, 0, "", "")}},
          value: {{number_format($creditTotal, 0, "", "")}},

          slide: function( event, ui ) {
            $( "#amount" ).val( ui.value );
            $( ".store-credit-value" ).text('Value: R '+ ui.value );
          }
        });

      });

      $(".apply-store-credit span").click(function(){
        window.location.replace("/store/credit/"+$( "#amount" ).val());
      });

      $(".store-credit em").click(function(){
        totalValue = {{number_format($walletTotal, 0, "", "")}};
        currentValue = Number($( "#amount" ).val());

        if($(this).hasClass('increase')){

          if(currentValue != totalValue){
            currentValue = currentValue + 1

            $( "#amount" ).val(currentValue);
            $( ".store-credit-value" ).text('Value: R '+ (currentValue) );
          }

        }else if($(this).hasClass('decrease')){

          if(currentValue != 0){
            $( "#amount" ).val(currentValue-1);
            $( ".store-credit-value" ).text('Value: R '+ (currentValue-1) );
          }

        }
      });
  </script>
  @endif
@endif
