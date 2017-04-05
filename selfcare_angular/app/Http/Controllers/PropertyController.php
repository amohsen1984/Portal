<?php

namespace App\Http\Controllers;
use App\api_wrapper;
use Illuminate\Http\Request;
use App\Http\Requests;

class PropertyController extends Controller
{
    public function create($id)
    {
        $property = api_wrapper::api_call('property', $id, 'GET', array());
        $property = json_decode($property, true);
        return view('pages.property', array('property' => $property[$id]));
        
    }
}

?>