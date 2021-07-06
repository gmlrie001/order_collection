<?php

namespace Vault\OrderCollection;


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

}
