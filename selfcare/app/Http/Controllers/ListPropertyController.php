<?php
namespace App\Http\Controllers;

use App\api_wrapper;

use Illuminate\Http\Request;

use App\Http\Requests;

class ListPropertyController extends Controller
{
    public function create($search = null)
    {
        if (empty($search)) {
            $property_list = api_wrapper::api_call('property', null, 'GET', array());
           
        } else {
          $property_list = api_wrapper::api_call('property', null, 'GET', array('property_address' => "contain($search)")); 
        }
       // echo $property_list ;
        return view('pages.properties_list', array('property_list' => json_decode($property_list, true)));
    }
}
?>