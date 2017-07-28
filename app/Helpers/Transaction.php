<?php

namespace App\Helpers;

use HNG\Http\Exception\InvalidRequest;

class Transactions {

    /**
     * Get transaction data from payload
     *
     * @param  array  $body
     * @return array
     */
    protected static function getTransactionDataFromPayload(array $body)
    {
    	$data = [
    		'item'                 => [],
    		'date_paid'            => time(),
    		'modified'             => new MongoDate(time()),
    		'phone'                => array_get($body, 'phone'),
    		'title'                => array_get($body, 'title'),
    		'email'                => array_get($body, 'email'),
    		'unique_id'            => array_get($body, 'book_id'),
    		'lname'                => array_get($body, 'lastname'),
    		'vendor_id'            => array_get($body, 'hotel_id'),
    		'paid'                 => array_get($body, 'has_paid'),
    		'pay_option'           => array_get($body, 'book_type'),
    		'fname'                => array_get($body, 'firstname'),
    		'value'                => array_get($body, 'book_value'),
    		'vendor_name'          => array_get($body, 'hotel_name'),
    		'vendor_city'          => array_get($body, 'hotel_city'),
    		'vendor_state'         => array_get($body, 'hotel_state'),
    		'vendor_email'         => array_get($body, 'hotel_email'),
    		'status'               => array_get($body, 'book_status'),
    		'is_corporate'         => array_get($body, 'is_corporate'),
    		'vendor_address'       => array_get($body, 'hotel_address'),
    		'commission_value'     => array_get($body, 'commission_value'),
    		'vendor_deal_status'   => array_get($body, 'hotel_deal_status'),
    		'commission_collected' => array_get($body, 'commission_collected'),
    		'for_lname'            => array_get($body, 'on_behalf_of_last_name'),
    		'start'                => new MongoDate(strtotime($body["checkin"])),
    		'added'                => new MongoDate(strtotime($body["added_on"])),
    		'end'                  => new MongoDate(strtotime($body["checkout"])),
    		'for_fname'            => array_get($body, 'on_behalf_of_first_name'),
    		'date'                 => new MongoDate(strtotime(array_get($body, 'book_date'))),
    	];

    	foreach (array_get($body, 'room_details', []) as $room) {
    		$data['item'][] = [
    			'quantity'     => $room['num'],
    			'name'         => $room['name'],
    			'price'        => $room['price'],
    			'buying_rate'  => $room['buying_rate'],
    			'selling_rate' => $room['selling_rate'],
    		];
    	}

    	return $data;
    }

    /**
     * Create new transactions data
     *
     * @param  array  $body
     * @param  array  $transaction_data
     * @return array
     */
    protected static function createNewTransactionPayload(array $body, array $transaction_data)
    {
    	return [
    		'commission_paid'      => 0,
    		'invoice_id'           => 0,
    		'created_on'           => date('y-m-d h:i:s',time()),
    		'unique_id'            => array_get($body, 'book_id'),
    		'vendor_id'            => array_get($body, 'hotel_id'),
    		'paid'                 => array_get($body, 'has_paid'),
    		'vendor_acc'           => array_get($body, 'vendor_acc'),
    		'data'                 => json_encode($transaction_data),
    		'value'                => array_get($body, 'book_value'),
    		'status'               => array_get($body, 'book_status'),
    		'for_fname'            => array_get($body, 'on_behalf_of_first_name'),
    		'for_lname'            => array_get($body, 'on_behalf_of_last_name'),
    		'customer_acc'         => array_get($body, 'customer_acc'),
    		'hotelsng_acc'         => array_get($body, 'hotelsng_acc'),
    		'vendor_expects'       => array_get($body, 'vendor_expected'),
    		'commission_value'     => array_get($body, 'commission_value'),
    		'customer_expects'     => array_get($body, 'customer_expected'),
    		'hotelsng_expects'     => array_get($body, 'hotelsng_expected'),
    		'commission_collected' => array_get($body, 'commission_collected'),
    		'vendor_city'          => array_get($transaction_data, 'vendor_city'),
    		'vendor_name'          => array_get($transaction_data, 'vendor_name'),
    		'vendor_state'         => array_get($transaction_data, 'vendor_state'),
    		'checkin'              => date('Y-m-d',strtotime(array_get($body, 'checkin'))),
    		'checkout'             => date('Y-m-d',strtotime(array_get($body, 'checkout'))),
    	];
    }
    
}