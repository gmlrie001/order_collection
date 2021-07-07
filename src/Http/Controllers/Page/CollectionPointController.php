<?php

namespace Vault\OrderCollection\Http\Controllers\Page;

use App\Http\Controllers\Services\PageController;

use Illuminate\Http\Request;


use Vault\OrderCollection\OrderCollection;


class CollectionPointController extends PageController
{

  public $collect;


  public function __construct()
  {
    parent::__construct();

    $this->collect = new OrderCollection();

    return $this;
  }

  public function index( Request $request )
  {
    // dd( __METHOD__, __LINE__, $this, new \ReflectionClass( $this->collect ), request()->all() );

    return $this->collect->collection( $request );
  }

}
