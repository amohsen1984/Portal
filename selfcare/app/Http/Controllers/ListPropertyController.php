<?php
namespace App\Http\Controllers;

use App\api_wrapper;

use Illuminate\Http\Request;

use App\Http\Requests;

class ListPropertyController extends Controller
{
    public function create()
    {
        $property_list = api_wrapper::api_call('property', null, 'GET', array());
        return view('pages.properties_list', array('property_list' => json_decode($property_list, true)));
    }
    
}
?>