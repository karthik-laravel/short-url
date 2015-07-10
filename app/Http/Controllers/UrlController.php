<?php

namespace App\Http\Controllers;
use Request;
use Input;
use Session;
//use Illuminate\Http\Request;
use App\Url;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class UrlController extends Controller
{
    
    public function index()
    {
		$urls=Url::all();
        return view('url',compact('urls'));
    }

    
    public function create()
    {
		return view('url');        
    }

 
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
