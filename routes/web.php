<?php

use Illuminate\Support\Facades\Session;

/**
 * Frontend routes for this package
 */

Route::middleware( ['web'] )->group( function() {

  // Route::get('profile/order_collection', 'Vault\OrderCollect\Controllers\OrderCollection@index');
  Route::get( 'profile/order_collection', function()
  {
    if(Session::has('user.id') && Session::get('user.id') != null){
        $this->data['user'] = \App\Models\User::find( Session::get('user.id'));
        $this->data['criteo_email'] = $this->data['user']->email;

        if(Session::has('basket.id')){
            $crt_id = Session::get('basket.id');
            $crt = \App\Models\Basket::find($crt_id);

            if($crt->order_state != null){
                $cart_id = \App\Models\Basket::where('order_state', null)->where('user_id', Session::get('user.id'))->value('id');

                if($cart_id != null) {
                    $this->data['cart_products'] = \App\Models\BasketProduct::where('basket_id', $cart_id)->get();
                    $this->data['cart_total'] = \App\Models\BasketProduct::where('basket_id', $cart_id)->sum('quantity');
                    $this->data['cart_price'] = \App\Models\BasketProduct::where('basket_id', $cart_id)->sum('price');

                }else{
                    $this->data['cart_products'] = array();
                    $this->data['cart_total'] = 0;
                    $this->data['cart_price'] = 0;
                }

            }else{
                $this->data['cart_products'] = \App\Models\BasketProduct::where('basket_id', Session::get('basket.id'))->get();
                $this->data['cart_total'] = \App\Models\BasketProduct::where('basket_id', Session::get('basket.id'))->count();
                $this->data['cart_price'] = \App\Models\BasketProduct::where('basket_id', Session::get('basket.id'))->sum('price');
            }

        }else{
            $cart_id = \App\Models\Basket::where('order_state', null)->where('user_id', Session::get('user.id'))->value('id');

            if($cart_id != null) {
                $this->data['cart_products'] = \App\Models\BasketProduct::where('basket_id', $cart_id)->get();
                $this->data['cart_total'] = \App\Models\BasketProduct::where('basket_id', $cart_id)->sum('quantity');
                $this->data['cart_price'] = \App\Models\BasketProduct::where('basket_id', $cart_id)->sum('price');

            }else{
                $this->data['cart_products'] = array();
                $this->data['cart_total'] = 0;
                $this->data['cart_price'] = 0;
            }
        }

    }else{
        $this->data['user'] = null;
        $this->data['criteo_email'] = "";
  
        if(Session::has('basket.id')){
            $this->data['cart_products'] = \App\Models\BasketProduct::where('basket_id', Session::get('basket.id'))->get();
            $this->data['cart_total'] = \App\Models\BasketProduct::where('basket_id', Session::get('basket.id'))->count();
            $this->data['cart_price'] = \App\Models\BasketProduct::where('basket_id', Session::get('basket.id'))->sum('price');
            $this->data['cart'] = \App\Models\Basket::find( Session::get('basket.id') );
        }else{
            $this->data['cart_products'] = array();
            $this->data['cart_total'] = 0;
            $this->data['cart_price'] = 0;
            $this->data['cart'] = new \App\Models\Basket();
        }
    }

    if ( ! session()->has('basket.id') ) session()->put( 'basket.id', 274 );
    $cart = $this->data['cart'] = \App\Models\Basket::find( Session::get('basket.id') );
    // dd( Session::all(), $this->data['cart'] );

    $this->data['page'] = \App\Models\Page::findOrFail(12);
    $this->data['site_settings'] = \App\Models\Site::firstOrFail();

    $this->data['prod_cats'] = \App\Models\ProductCategory::whereNull('parent_id')->where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->orderBy('order', 'asc')->get();
    
    $this->data['quick_links'] = \App\Models\QuickLink::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->orderBy('order', 'asc')->limit(4)->get();
    
    $this->data['selling_points'] = \App\Models\SellingPoint::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->orderBy('order', 'asc')->get();
    
    $this->data['socials'] = \App\Models\SocialMedia::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->orderBy('order', 'asc')->get();
    
    $this->data['pay_options'] = \App\Models\PaymentOption::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->orderBy('order', 'desc')->get();
    
    $this->data['links'] = \App\Models\Link::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->orderBy('order', 'asc')->get();
    
    $this->data['footer_link_categories'] = \App\Models\FooterLinkCategory::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->orderBy('order', 'asc')->get();

    $this->data['service_footer_links'] = \App\Models\FooterLink::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->where('section', 'service')->orderBy('order', 'asc')->get();
    
    $this->data['shop_footer_links'] = \App\Models\FooterLink::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->where('section', 'shop')->orderBy('order', 'asc')->get();
    
    $this->data['about_footer_links'] = \App\Models\FooterLink::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->where('section', 'about')->orderBy('order', 'asc')->get();

    $this->data['footer_links'] = \App\Models\FooterLink::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->orderBy('order', 'asc')->get();
    
    $this->data['info_pages'] = \App\Models\InformationPage::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->orderBy('order', 'asc')->get();

    $this->data['Address'] =\App\Models\ Address::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->orderBy('order', 'asc')->first();

    $this->data['order'] = \App\Models\Basket::findOrFail(274);

    $this->data['can_assemble'] = false;
    $this->data['areas'] = \App\Models\DeliveryArea::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->where('postal_codes', 'LIKE', '%'.$cart->delivery_postal_code.'%')
      ->where(function($query) use ($cart){
        $query->whereHas('displayOptions');
        $query->where(function($query) use ($cart){
            $query->whereHas('displayOptions.shippingOption', function($query){
                $query->where('default_cost', '!=', null);
            })->orWhereHas('displayOptions.shippingOption.displayRates', function($query) use ($cart){
                $query->where(function($query) use ($cart){
                    $query->where('condition', 'Price')
                    ->where('min_condition', '<=', $cart->total)
                    ->where('max_condition', '>=', $cart->total);
                })->orWhere(function($query) use ($cart){
                    $total_items = $cart->products->sum('quantity');
                    $query->where('condition', 'Item Count')
                    ->where('min_condition', '<=', $total_items)
                    ->where('max_condition', '>=', $total_items);
                });
            });
        }); 
    })->get();

    $this->data['collection_options'] = \App\Models\ShippingOption::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->where("for_collection", 'yes')->get();

    $this->data['collection_points'] = \App\Models\CollectionPoint::where(function($query){
        $query->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')->where('status_date', '>=', now());
    })->get();
    
    foreach($this->data['areas'] as $area) {
        if($area->product_assembly == "yes" && $cart->collection_code == null) {
            $this->data['can_assemble'] = true;
        }
    }

    if ( ! session()->has( 'user_id' ) ) session()->put( 'user_id', $cart->user_id );

    return view( 'order_collection::step3', $this->data );
  });

});
