<?php

namespace App\Http\Controllers;
use Request;
use Input;
use Session;
use App\Url;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class UrlController extends Controller
{
    
    public function index()
    {		
        return view('url');
    }

	// save long_url and create short_url
    public function store()
    {
		if(Request::ajax()) {
			$data = Input::all();		  
			$id=rand(10000,99999);  
			$shorturl=base_convert($id,20,36); 
			$data['short_url']=$shorturl	;		
			Url::create($data);
			echo json_encode($data);	  
		}
    }

    // retrieve short url and redirect to actual url
	public function handleShortcode( $shortCode )
    {
		$url=Url::where('short_url',$shortCode)->get();		
        if (count($url)>0) {
            return Redirect::to($url[0]['original']['long_url'], 302 );
        } else {
			Session::flash('message', 'This Short Url Is Not Valid!');
			Session::flash('alert-class', 'alert-danger'); 
			return Redirect::to('urls');		
        }
    }
}
