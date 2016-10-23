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
            'code' => $request['postcode'],
            'description' => $request['description'],
            'address' => $request['address'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'status' => 'AwaitingAgent',
            'i_seller' => '1',
            'price' => $request['price'],
            'type' => $request['type'],
            'floors' => $request['floors'],
            'bedrooms' => $request['bedrooms'],
            'bathrooms' => $request['bathrooms'],
            'reception_rooms' => $request['reception'],
            'new_built' =>  $request['new_built'],
            'chain' => $request['chain']
        ];
    $result = api_wrapper::api_call('property', null, 'POST', $property);
    if ($result == "[]"): $result = "Property Added Succesfully"; 
    else: $result = "There was an error with your request";   
    endif;
    return view('pages.add_property', ['error' => $result]);
    }
    
}