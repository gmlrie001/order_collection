<?php

namespace Vault\OrderCollection;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

use App\Models\Basket;
use App\Models\UserAddress;
use App\Models\ShippingOption;

use Vault\OrderCollection\Models\CollectionPoint;


class OrderCollection
{

  public $packageNamespace;


  public function __construct()
  {
    $this->packageNamespace = __NAMESPACE__; // dirname( get_called_class() );

    return $this;
  }

  public static function newInstance()
  {
    return new static();
  }

  public static function version()
  {
    // self::$version = 'v0.5';
    return 'v1.0.0';
  }

  public static function packageNamespace()
  {
    // self::$version = 'v0.5';
    return 'Vault\\OrderCollection';
  }

  public static function addCollectionPointsToDelivery( $userId=null )
  {
    // if ( is_null( $userId ) || ! isset( $userId ) ) $userId = session()->get( 'user.id' );

    return CollectionPoint::where( 'status', 'PUBLISHED' )->get();
  }

  public static function addCollectionToDeliveryOptions()
  {
    $collection_options = ShippingOption::where( 'status', 'PUBLISHED' )
                                        ->orWhere( 'status', 'SCHEDULED' )
                                          ->where( 'status_date', '>=', now() )
                                        ->where( 'for_collection', 'yes')
                                        ->get();

    $collection_points = static::addCollectionPointsToDelivery();
    
    return [
      'options' => $collection_options,
      'points'  => $collection_points,
    ];
  }

  public static function initializeCartCollectionCode( Basket $cart=null )
  {
    if ( get_class( $cart ) instanceof Basket || is_null( $cart ) ) throw new \Exception( 'Input must be an instance of Basket.' );

    if (! Schema::hasColumn($cart->getTable(), 'collection_code')) {
      throw new \Exception( 'Please install the Order Collection package to use this feature!' );
    }

    $cart->update(['collection_code' => null]);
    $cart->save();

    return $cart;
  }

  public static function setShipperAsCollection()
  {
    return [
      'shipper'    => 'Collection',
      'shipperOpt' => 'Collection',
    ];
  }

  public function collection( Request $request )
  {
      $basket  = ( $request->has( 'cart_id' ) ) ? Basket::find( $request->get( 'cart_id' ) ) : null;
      session()->put('cart_id', $request->get( 'cart_id' ));

      $point   = ( $request->has( 'collection_id' ) ) ? CollectionPoint::find( $request->get( 'collection_id' ) ) : null;
      session()->put('collection_id', $request->get( 'collection_id' ));

      $address = ( $request->has( 'address_id' ) ) ? UserAddress::find( $request->get( 'address_id' ) ) : null;
      session()->put('address_id', $request->get( 'address_id' ));

      //add code to order
      $basket->collection_code = $point->collection_code;

      //add collection point as shipping address
      $basket->delivery_name    = $address->name;
      $basket->delivery_surname = $address->surname;
      $basket->delivery_phone   = $address->phone;
      $basket->delivery_company = $address->company;

      $basket->delivery_address_line_1 = $point->address_line_1;
      $basket->delivery_address_line_2 = $point->address_line_2;
      $basket->delivery_suburb         = $point->suburb;
      $basket->delivery_city           = $point->city;
      $basket->delivery_postal_code    = $point->postal_code;
      $basket->delivery_province       = $point->province;
      $basket->delivery_country        = $point->country;

      $basket->save();
      $this->data['cart'] = $basket;

      #update Basket shipping details from CollectionPoint Model
      /*
      $basket->shipping_title             = $point->shipping_title;
      $basket->shipping_description       = $point->shipping_description;
      $basket->shipping_time_of_arrival   = $point->shipping_time;
      $basket->shipping_cost              = $point->shipping_cost;
      $basket->collection_code            = $point->collection_code;
      */

      $data = static::setShipperAsCollection();
      session()->put( 'shipper', $data['shipper'] );
      session()->put( 'shipperOpt', $data['shipperOpt'] );

      // redirect to shipping options
      return redirect()->to( url( 'cart/delivery/option' ) )->withInput();
  }

}
