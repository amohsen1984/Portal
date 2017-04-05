<?php
namespace App\Http\Controllers;

use App\api_wrapper;

use Illuminate\Http\Request;

use App\Http\Requests;

class ListPropertyController extends Controller
{
    public function create($search = "")
    {
       /* if (empty($search)) {
            $property_list = api_wrapper::api_call('property', null, 'GET', array());
           echo 'no search';
        } else {
           $property_list = api_wrapper::api_call('property', null, 'GET', array('property_address' => "contain($search)", 'property_code' => "contain($search)")); 
          var_dump($property_list);
          echo 'search phrase: ' . $search;
          exit;
        }*/
        $property_list = array();
        return view('pages.properties_list', array("search" => $search, 'property_list' => $property_list));
    }
}
?>