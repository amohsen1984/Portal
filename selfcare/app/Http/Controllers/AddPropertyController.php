<?php

namespace App\Http\Controllers;

use App\api_wrapper;

use Illuminate\Http\Request;

use App\Http\Requests;

class AddPropertyController extends Controller
{
    public function create()
    {
        return view('pages.add_property');
    }

    public function store(Request $request)
    {
        
        if ($request['new'] == "yes"):
            $request['new'] = 1;
        elseif ($request['new'] == "no"): 
            $request['new'] = 0;
        else: 
            $request['new'] = null;
        endif;
            
        if ($request['chain'] == "yes"): 
            $request['chain'] = 1;
        elseif ($request['chain'] == "no"): 
            $request['chain'] = 0;
        else: 
            $request['chain'] = null;
        endif;   
            
        $property = [
            'property_code' => $request['postcode'],
            'property_description' => $request['description'],
            'property_address' => $request['address'],
            'property_city' => $request['city'],
            'property_state' => $request['state'],
            'property_country' => $request['country'],
            'property_status' => 'AwaitingAgent',
            'i_seller' => '1',
            'property_price' => $request['price'],
            'property_type' => $request['type'],
            'property_floors' => $request['floors'],
            'property_bedrooms' => $request['bedrooms'],
            'property_bathrooms' => $request['bathrooms'],
            'property_reception_rooms' => $request['reception'],
            'property_new_built' =>  $request['new_built'],
            'property_chain' => $request['chain']
        ];
        $seller = [
            'seller_name' => $request['seller_name'],
            'seller_email' => $request['seller_email'],
            'seller_phone' => $request['seller_phone'],
            'seller_address' => $request['seller_address'],
            'seller_post_code' => $request['seller_post_code'],
            'seller_city' => $request['seller_city']
        ];
    $result = api_wrapper::api_call('property', null, 'POST', $property);
    $result_2 = api_wrapper::api_call('seller', null, 'POST', $seller);
        
    if ($result == "[]" AND $result_2 == "[]"): $result = "Property Added Succesfully"; 
    else:  //$result = "There has been a problem with your query";   
    endif;
    return view('pages.add_property', ['error' => $result]);
    }
    
}