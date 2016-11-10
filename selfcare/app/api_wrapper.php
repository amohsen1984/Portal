<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class api_wrapper extends Model
{
    public static function api_call($object, $id, $method, $data) {
    
    //open connection
    $ch = curl_init();

    $url = "http://localhost:8080/Portal/api/public/index.php/$object";

    if(!empty($id)) 
        $url .= "/$id";

    $request_headers = array();
    $request_headers[] = 'login: portal';
    $request_headers[] = 'password: portal';
    $request_headers[] = 'customer: 1';
    

    
    if($method == 'GET' ) {
        
        $fields_string = '';
        foreach($data as $key=>$value) { 
            $fields_string .= $key.'='.$value.'&';
        }
        
        $fields_string = rtrim($fields_string, "&");
        if(!empty($fields_string))
            $url .= "?$fields_string";

        curl_setopt($ch,CURLOPT_URL, $url);
    
    }
    elseif($method == 'POST') {
    
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));                                                                                                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen(json_encode($data))                                                                      
        ));                                                                                                                   
  
    
    
    }
    elseif($method == 'DELETE') {
    
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");                                                                     

    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   

    curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
    //execute post
    $result = curl_exec($ch);

    //echo $result;
                    
    //close connection
    curl_close($ch);

        return $result;

}
    
    
}
