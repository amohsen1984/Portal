<?php

namespace App\Http\Controllers;

use App\api_wrapper;

use Illuminate\Http\Request;

use App\Http\Requests;

class AgentController extends Controller
{
    public function index()
    {
        $users_list = api_wrapper::api_call('user', null, 'GET', array());
        return view('user_list', array('users_list' => json_decode($users_list, true)));
    } 
}