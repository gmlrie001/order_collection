<?php

namespace Vault\OrderCollection\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectionPoint extends Model
{
    use SoftDeletes;
    
    public $orderable = true;
    public $orderField = "order";
    public $titleField = "title";
    public $statusField = "status";
    public $hasStatus = true;
    public $orderDirection = "asc";
    public $parentOrder = "";
    public $parentTable = "";
    public $orderOptions = ['title', 'shipping_title', 'shipping_description', 'shipping_time', 'shipping_cost'];
    public $relationships = [];
    public $mainDropdownField = "address_line_1";
    public $imageDropdownField = "";

    protected $fillable = [
		'title', 
		// 'shipping_title', 
		'shipping_description', 
		'address_line_1', 
		'address_line_2', 
		'postal_code', 
		'suburb', 
		'province', 
		'city', 
		'shipping_time', 
        'status', 
        'status_date', 
		'shipping_cost', 
		'country',  
        'collection_code', 
        'trading_hours',
        'latitude',
        'longitude',
    ];

    public $fields = [
    //  ['field_name', 'label', 'field_type', 'options_model', 'options_relationship', 'width', 'height', 'container_class', 'can_remove'],
        ['title', 'Title', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
        ['collection_code', 'Collection Code (for Pastel)', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],

        ['open_parent', 'Address Details', ''], 
            ['address_line_1', 'Address Line 1', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
            ['address_line_2', 'Address Line 2', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
            ['suburb', 'Suburb', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
            ['city', 'City', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
            ['postal_code', 'Postal Code', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
            ['province', 'Province', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
            ['country', 'Country', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
            ['trading_hours', 'Trading Hours', 'wysiwyg', '', '', '', '', 'col-xs-12', ''],
        ['close_parent', 'Address Details', ''], 
        
        ['open_parent', 'Map Coordinates', ''], 
            ['open_row', '', ''], 
                ['latitude', 'Latitude (deg|min|s)', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
                ['longitude', 'Longitude (deg|min|s)', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
            ['close_row', '', ''], 
        ['close_parent', 'Map Coordinates', ''], 

        ['open_parent', 'Collection Details', ''], 
            ['shipping_title', 'Title', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
            ['shipping_description', 'Description', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
            ['shipping_time', 'Estimated Time', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
            ['shipping_cost', 'Cost', 'text', '', '', '', '', 'col-xs-12 col-md-6', ''],
        ['close_parent', 'Collection Details', ''], 

        ['open_row', 'Status'], 
            ['status', 'Status', 'status', '', '', '', '', 'col-xs-12 col-md-6', ''],
        ['close_row', 'Status'], 
    ];

	/**
     * Get the user associated with the address.
     */
    public function user()
    {
       return $this->belongsTo( App\Models\User::class, 'user_id' );
    }
    
}
