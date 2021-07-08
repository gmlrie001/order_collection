<?php

/**
 * Portfolio module config settings.
 *
 */
return [

  'namespace' => 'Vault\\OrderCollection',


  /**
   * SEEDERS for the CollectionPoint model
   */
  'collection_point_seeder' => [
    [
      'title'                => 'Preparing options',
      'shipping_title'       => 'Option to be selected from the list.',
      'shipping_description' => 'Processsing - preparing options for presentation.',

      'address_line_1'       => 'Unit 105, Platinum Junction Business Park',
      'address_line_2'       => 'School Street',
      'postal_code'          => '7441',
      'suburb'               => 'Milnerton',
      'province'             => 'Western Cape',
      'city'                 => 'Cape Town',
      'country'              => 'South Africa',

      'latitude'             => '-33.8770001',
      'longitude'            => '18.5033585',

      'shipping_time'        => null,
      'collection_code'      => 'PROCESSING',
      'trading_hours'        => null, 
      'shipping_cost'        => 0.00,

      'created_at'           => '2020-04-07 10:10:43',
      'updated_at'           => '2020-06-27 11:56:12',
      'deleted_at'           => null,

      'status'               => 'DRAFT',
      'status_date'          => null,

      'order'                => 1,
    ], [
      'title'                => 'Collect from us',
      'shipping_title'       => 'Collect from us',
      'shipping_description' => 'Collection From All American Auto Store',

      'address_line_1'       => 'Unit 105, Platinum Junction Business Park',
      'address_line_2'       => 'School Street',
      'postal_code'          => '7441',
      'suburb'               => 'Milnerton',
      'province'             => 'Western Cape',
      'city'                 => 'Cape Town',
      'country'              => 'South Africa',

      'latitude'             => '-33.8770001',
      'longitude'            => '18.5033585',

      'shipping_time'        => '1-3 Days Upon Arrival in Port',
      'collection_code'      => 'AA_COLLECT',
      'trading_hours'        => "<p>Mon-Fri: 08:00 - 17:00</p><p>Sat: 09:00 - 13:00</p><p>Sun: Closed</p>",
      'shipping_cost'        => 0.00,

      'created_at'           => '2020-04-07 10:20:43',
      'updated_at'           => '2020-06-27 12:06:12',
      'deleted_at'           => null,

      'status'               => 'PUBLISHED',
      'status_date'          => null,

      'order'                => 2,
    ], 
  ],

];
