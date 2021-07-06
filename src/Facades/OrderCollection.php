<?php

namespace Vault\OrderCollection\Facades;

// Illuminate Facades
use Illuminate\Support\Facades\Facade;


class OrderCollection extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'order_collection';
    }

}
