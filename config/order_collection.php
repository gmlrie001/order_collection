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
      'shipping_description' => 'Processsing - preparing options for presentation.',

      'address_line_1'       => '',
      'address_line_2'       => '',
      'postal_code'          => '',
      'suburb'               => '',
      'province'             => 'Western Cape',
      'city'                 => 'Cape Town',
      'country'              => 'South Africa',

      'shipping_time'        => NULL,
      'collection_code'      => 'PROCESSING',
      'trading_hours'        => NULL, 
      'shipping_cost'        => number_format( 0, 2, ".", "" ),

      'created_at'           => date( 'Y-m-d H:i:s', strtotime("now") ),
      'updated_at'           => date( 'Y-m-d H:i:s', strtotime("now") ),
      'deleted_at'           => NULL,

      'status'               => 'DRAFT',
      'status_date'          => NULL,

      'order'                => 1,
    ], [
      'title'                => 'Collect from us',
      'shipping_title'       => 'Collect from us',
      'shipping_description' => 'Collection From Milnerton High School Pool',

      'address_line_1'       => 'Unit 105, Platinum Junction Business Park',
      'address_line_2'       => 'School Street',
      'postal_code'          => '7441',
      'suburb'               => 'Milnerton',
      'province'             => 'Western Cape',
      'city'                 => 'Cape Town',
      'country'              => 'South Africa',

      'shipping_time'        => '2-3 days after order has been confirmed',
      'collection_code'      => 'IS_COLLECT',
      'trading_hours'        => "<p>Mon-Fri: 08:00 - 17:00</p><p>Sat: 09:00 - 13:00</p><p>Sun: Closed</p>",
      'shipping_cost'        => number_format( 0, 2, ".", "" ),

      'created_at'           => date( 'Y-m-d H:i:s', strtotime("now") ),
      'updated_at'           => date( 'Y-m-d H:i:s', strtotime("now") ),
      'deleted_at'           => NULL,

      'status'               => 'PUBLISHED',
      'status_date'          => NULL,

      'order'                => 2,
    ], 
  ],

];
