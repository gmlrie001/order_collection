<?php

return [
  /**
   * Order Collection module config settings.
   *
   */

  'namespace' => 'Vault\\OrderCollection',

  /**
   * SEEDERS for the CollectionPoint model
   */
  'collection_point_seeder' => [
    [
      'title'                => 'Preparing options',
      'shipping_title'       => 'Option to be selected from the list.',
      'shipping_description' => 'Processsing - preparing options for checkout step 3 - delivery options',

      'address_line_1'       => null,
      'address_line_2'       => null,
      'postal_code'          => null,
      'suburb'               => null,
      'province'             => 'Western Cape',
      'city'                 => 'Cape Town',
      'country'              => 'South Africa',

      'shipping_time'        => null,
      'collection_code'      => 'PROCESSING',
      'trading_hours'        => null, 
      'shipping_cost'        => number_format(0, 2, ".", ""),

      'created_at'           => date('Y-m-d H:i:s', strtotime("now")),
      'updated_at'           => date('Y-m-d H:i:s', strtotime("now")),
      'deleted_at'           => null,

      'status'               => 'DRAFT',
      'status_date'          => NULL,

      'order'                => 1,
    ], [
      'title'                => 'Collect from us',
      'shipping_title'       => 'Collect from us',
      'shipping_description' => null,

      'address_line_1'       => null,
      'address_line_2'       => null,
      'postal_code'          => null,
      'suburb'               => null,
      'province'             => null,
      'city'                 => null,
      'country'              => null,

      'shipping_time'        => '2-3 days after order has been confirmed',
      'collection_code'      => 'IS_COLLECT',
      'trading_hours'        => null,
      'shipping_cost'        => number_format(0, 2, ".", ""),

      'created_at'           => date('Y-m-d H:i:s', strtotime("now")),
      'updated_at'           => date('Y-m-d H:i:s', strtotime("now")),
      'deleted_at'           => NULL,

      'status'               => 'PUBLISHED',
      'status_date'          => NULL,

      'order'                => 2,
    ], 
  ],

];
