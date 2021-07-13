<div class="col-12 cart-addresses user-address-select my-lg-4 my-3">

    <h1 class="delivery-option-title w-100" data-option="collect-option">
        <b class="mr-lg-auto">ORDER COLLECTION</b>
        <span class="mt-lg-0" style="text-transform:none;">
            Collect your order from our store/warehouse.
            <!-- <img class="img-fluid" src="/assets/images/checkout/collect-icon.svg" /> -->
        </span>
    </h1>

    <div class="option-hide-me collect-option">
        <div class="col-12 p-0 user-addresses colection-addresses">
            <div class="col-12 p-0 address-info" data-addressid="1">
                <h1 class="d-flex flex-row align-items-center d-lg-block">
                    <strong class="font-weight-regular mr-auto">Collect your order from our store/warehost</strong>
                    <i class="fa fa-circle" aria-hidden="true"></i>
                </h1>
            </div>
        </div>

        <div class="col-12 p-0 user-address-select">
            <h1>Select billing address</h1>
        </div>

        <div class="col-12 p-0 user-addresses collection-billing">
            @foreach($user_addresses as $user_address)
            <div class="col-12 p-0 address-info" data-addressid="{{$user_address->id}}">
                <h1>
                    <a class="delete-address float-left confirm-delete" href="/address/delete/{{$user_address->id}}"><i class="fa fa-trash"></i></a>
                    {{$user_address->address_name}}

                  @if($user_address->default_address == 1)
                    <?php $billingid = $user_address->id; ?>
                    <i class="fa fa-check-circle active" aria-hidden="true"></i>
                  @else
                    <i class="fa fa-circle" aria-hidden="true"></i>
                  @endif

                    <span class="my-lg-0">Use this address</span>
                </h1>
                <div class="col-12">
                    <div class="col-12 col-md-6 float-left">
                        <div class="col-12 p-0">
                            <div class="row">
                                <p class="col-12 col-md-6">First Name:</p>
                                <p class="col-12 col-md-6">{{$user_address->name}}</p>
                            </div>
                        </div>
                        <div class="col-12 p-0">
                            <div class="row">
                                <p class="col-12 col-md-6">Company Name:</p>
                                <p class="col-12 col-md-6">{{$user_address->company}}</p>
                            </div>
                        </div>
                        <div class="col-12 p-0">
                            <div class="row">
                                <p class="col-12 col-md-6">VAT Number:</p>
                                <p class="col-12 col-md-6">{{$user_address->vat_number}}</p>
                            </div>
                        </div>
                        <div class="col-12 p-0">
                            <div class="row">
                                <p class="col-12 col-md-6">Surburb:</p>
                                <p class="col-12 col-md-6">{{$user_address->suburb}}</p>
                            </div>
                        </div>
                        <div class="col-12 p-0">
                            <div class="row">
                                <p class="col-12 col-md-6">Province / State:</p>
                                <p class="col-12 col-md-6">{{$user_address->province}}</p>
                            </div>
                        </div>
                        <div class="col-12 p-0">
                            <div class="row">
                                <p class="col-12 col-md-6">Postal Code:</p>
                                <p class="col-12 col-md-6">{{$user_address->postal_code}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 float-left">
                        <div class="col-12 p-0">
                            <div class="row">
                                <p class="col-12 col-md-6">Last Name:</p>
                                <p class="col-12 col-md-6">{{$user_address->surname}}</p>
                            </div>
                        </div>
                        <div class="col-12 p-0">
                            <div class="row">
                                <p class="col-12 col-md-6">Street Address:</p>
                                <p class="col-12 col-md-6">{{$user_address->address_line_1}},
                                    {{$user_address->address_line_2}}</p>
                            </div>
                        </div>
                        <div class="col-12 p-0">
                            <div class="row">
                                <p class="col-12 col-md-6">City / Town:</p>
                                <p class="col-12 col-md-6">{{$user_address->city}}</p>
                            </div>
                        </div>
                        <div class="col-12 p-0">
                            <div class="row">
                                <p class="col-12 col-md-6">Country:</p>
                                <p class="col-12 col-md-6">{{$user_address->country}}</p>
                            </div>
                        </div>
                        <div class="col-12 p-0">
                            <div class="row">
                                <p class="col-12 col-md-6">Phone Number:</p>
                                <p class="col-12 col-md-6">{{$user_address->phone}}</p>
                            </div>
                        </div>
                        <span class="col-12 text-right">May be printed on the label to assist delivery</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-12 float-left p-0 mt-4 add-address">
            <a href="#" class="float-left">Add address</a>
	    @php
		$user->load( 'addresses' );

		$defaultUserAddy = $user->addresses->where( 'default_address', 1 )->first();
		$defaultUserAddy = ( NULL == $defaultUserAddy ) ? $user_addresses->first() : $defaultUserAddy;

                if ( sizeof($user_addresses) && NULL != $defaultUserAddy ) {
		    $shippingid = ( ! isset( $shippingid ) ) ? $defaultUserAddy->id : $shippingid;
		    $billingid  =  ( ! isset( $billingid ) ) ? $defaultUserAddy->id :  $billingid;
                
                } else {
		    $billingid  =  ( ! isset( $billingid ) ) ? $billingid : 0;
                }
	    @endphp
            @if(sizeof($user_addresses))
              <form action="/cart/collection" method="post" class="col-12 col-md-4 float-right p-0 mt-5 mt-lg-0">
                {!!Form::token()!!}
                {!!Form::hidden('cart_id', $cart_id)!!}
                {!!Form::hidden('collection_id', '1')!!}
                {!!Form::hidden('address_id', $billingid)!!}
                <input class="continue-button" type="submit" value="continue">
              </form>
            @endif
        </div>
    </div>
</div>
