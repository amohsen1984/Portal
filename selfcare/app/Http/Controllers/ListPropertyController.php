<?php
namespace App\Http\Controllers;

use App\api_wrapper;

use Illuminate\Http\Request;

use App\Http\Requests;

class ListPropertyController extends Controller
{
    public function create($search = "")
    {
        if (empty($search)) {
            $property_list = api_wrapper::api_call('property', null, 'GET', array());
           echo 'no search';
        } else {
           $property_list = api_wrapper::api_call('property', null, 'GET', array('property_address' => "contain($search)", 'property_code' => "contain($search)")); 
          
          echo 'search phrase: ' . $search;
        }
        return view('pages.properties_list', array('property_list' => json_decode($property_list, true)));
    }
}
?>