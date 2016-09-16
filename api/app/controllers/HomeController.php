<?php

use Illuminate\Http\Request;

class HomeController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function showWelcome($object, $id) {
        var_dump($_GET);
        return $id . " " . $object;
        //return View::make('hello');
    }

    public function update($id) {
        // First we fetch the Request instance
       // $request = Request::instance();
// Now we can get the content from it
        //$content = $request->getContent();
        //var_dump($request);
        $rawPostData = file_get_contents("php://input");
        echo $rawPostData;
        return "ssss ";
        //return View::make('hello');
    }

}
