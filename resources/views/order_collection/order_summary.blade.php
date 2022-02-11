@php
$canContinue = false;

if ($shipper != NULL   || 
   ! empty( $shipper ) || $shipper) {
  $shippersOriginal = $shipper;

  if (array_key_exists( 'collection', $shipper )) {
    $shipper = $shipper['collection'];
  }

} else {
    $shipper = [];
}
@endphp

<div class="col-12 col-lg-3 custom-checkout-padding">
    <div class="row">
        <div class="col-12 payment-order-summary pre-payment">
            <h2>Order Summary:</h2>
            @php
              $cart = $order;
              $subTotal = $order->subtotal;

              /** Any Discounts Applied to the Order */
              if($cart->discount == 0){
                $discountTotal = 0;
              
              } else {
                if ( $cart->discount_type == 0 ) {
                  $discountTotal = $total_cost * ( $cart->discount * 0.01 );
              
                } else {
                  $discountTotal = $cart->discount;
                }
              }
              $subTotal = $subTotal - $discountTotal;

              /** Any Coupons Used for this the Order */
              if ( $order->coupon == null ) {
                $couponTotal = 0;
              
              } else {
                $couponTotal = $order->coupon_value;
              }
              $subTotal = $subTotal - $couponTotal;

              /** Any Store Credit Assistance in this Order */
              if ( $order->store_credit_value == null ) {
                $creditTotal = 0;
              
              } else {
                $creditTotal = $order->store_credit_value;
              }
              $subTotal = $subTotal - $creditTotal;

              /** Any Products that Qualify for Assembly and Selected for on this Order */
              $assembly_costs = 0;
              
              foreach ( $order->products as $product ) {
                if ( $product->product->assembly_cost != null ) {
                  $assembly_costs += $product->assembly_cost * $product->quantity;
                }
              }
              $subTotal += $assembly_costs;

              $total_cost = $order->subtotal;
            @endphp

          @if($total_cost)
            <p class="text-right"><span>Cost:</span> R {{number_format($total_cost, 0, "", "")}}</p>
          @endif

          @if($assembly_costs)
            <p class="text-right" style="color: green;"><span>Assembly Cost:</span> R {{number_format($assembly_costs, 0, "", "")}}</p>
          @endif
          
          @if($discountTotal != 0)
            <p class="text-right" style="color: #b80303;"><span>Discount:</span> -R {{number_format($discountTotal, 0, "", "")}}</p>
          @endif
          
          @if($couponTotal != 0)
            <p class="text-right" style="color: #b80303;"><span>Coupon:</span> -R {{number_format($couponTotal, 0, "", "")}}</p>
          @endif
          
          @if($creditTotal != 0)
            <p class="text-right" style="color: #b80303;"><span>Store Credit:</span> -R {{number_format($creditTotal, 0, "", "")}}</p>
          @endif
          
          @if($subTotal)
            <h3 class="text-right"><span>Total</span> R {{number_format($subTotal, 0, "", "")}}</h3>
          @endif
          
          @if($cart_total)
            <h4>Items in Basket: <span class="float-right">{{$cart_total}}</span></h4>
          @endif

          @if ( is_array( $shipper ) && NULL != $order )
            <h4>Shipping / Collection Info:</h4>
            @if ( {{--strtolower( $shipper ) === 'collection ' || --}} ( NULL != $order->collection_code && $order->collection_code != '' ) )
            <p>
              <u>Order Collection/Pickup Selected</u>
            </p>
            <address class="order-summary"></address>
            @else
              @if ( request()->is( 'cart/payment' ) )
              <address class="order-summary">
                <p>
                @if( $order->delivery_address_line_1 != NULL || $order->delivery_address_line_1 != "" )
                  {{$order->delivery_address_line_1}}, <br>
                @endif

                @if($order->delivery_address_line_2 != "" || $order->delivery_address_line_2 != NULL)
                  {{$order->delivery_address_line_2}}, <br>
                @endif

                @if($order->delivery_suburb != "" || $order->delivery_suburb != NULL)
                  {{$order->delivery_suburb}}, <br>
                @endif

                @if($order->delivery_city != "" || $order->delivery_city != NULL)
                  {{$order->delivery_city}}, <br>
                @endif

                @if($order->delivery_postal_code != "" || $order->delivery_postal_code != NULL)
                  {{$order->delivery_postal_code}}, <br>
                @endif

                @if($order->delivery_province != "" || $order->delivery_province != NULL)
                  {{$order->delivery_province}}, <br>
                @endif

                @if($order->delivery_country != "" || $order->delivery_country != NULL)
                  {{$order->delivery_country}}
                @endif
                </p>
              </address>
              @endif
            @endif
          @endif
        </div>

        {{--
        @if ( request()->is( 'cart/view' ) || request()->is( 'cart/delivery' ) )
          @include( 'order_collection::order_discounts' )
        @endif
        --}}
        
        @includeIf(request()->is( 'cart/view' ) || request()->is( 'cart/delivery' ), 'order_collection::order_discounts')

        <form class="col-12 p-0 shipping-option-form-results" action="/cart/payment" method="post">
            {!! Form::token() !!}
            {!! Form::hidden('cart_id', $order->id) !!}
            
            <input type="hidden" name="shipping_title" value="">
            <input type="hidden" name="option" value="">
            <input type="hidden" name="collection_code" value="">
            <input type="hidden" name="shipping_description" value="">
            <input type="hidden" name="shipping_time_of_arrival" value="">
            
            {!! Honeypot::generate('my_time_delvieryOptions', 'my_name_delvieryOptions') !!}
            
            @if(sizeof($areas) || isset($free_shipping))
              <input class="continue-button" type="submit" value="continue" name="basketDelivery" @if( ! $canContinue ) disabled @endif />
            @else
              @php
                $telNumber = NULL;
                if ( \App\Models\Address::count() >= 1 ) {
                    $telNumber = \App\Models\Address::first()->pluck('phone');
                }
              @endphp
              <h4>Oops! No shipping to your postal code</h4>
              <p>
                @if ( NULL != $telNumber )
                Please contact us on <a rel="noopener noreferer" title="Call Us" href="tel:0877401800" target="_blank">tel:{{$site_settings}}</a> 
                <br> 
                OR 
                @endif
                Please email us at <a rel="noopener noreferer" class="" title="Contact us via email" href="mailto:{{ $site_settings->contact_email }}">{{ $site_settings->contact_email }}</a> for assistance. 
                <br>
                Thank you for your patience.
                <br>
              </p>
            @endif
        </form>

    </div>
</div>
