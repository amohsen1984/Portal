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
        $property = [
            'code' => $request['postcode'],
            'description' => $request['description'],
            'address' => $request['address'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'status' => 'AwaitingAgent',
            'i_seller' => '1',
            'price' => $request['price']
        ];
    $error = api_wrapper::api_call('propertie', null, 'POST', $property);
    if ($error == "[]"): $error = "Property Added Succesfully"; 
    else: $error = "There was an error with your request";   
    endif;
    return view('pages.add_property', ['error' => $error]);
    }
    
}