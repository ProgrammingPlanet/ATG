<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Atg;

class AtgController extends Controller
{
    public function index()
    {
        $data = Atg::all()->toArray();
        
    	return view('Atg',["persons"=>$data]);

    }

    public function store(Request $request)
    {
    	$request->validate([

    		'name'	=>	'bail|required|alpha_spaces|unique:persons',
    		'email'	=>	'bail|required|email|unique:persons',
    		'pin'	=>	'bail|required|unique:persons|digits:6',

    	]);

    	$person = new Atg();

    	$person->name = $request->post('name');
    	$person->email = $request->post('email');
    	$person->pin = $request->post('pin');

    	$person->save();

    	return view('Atg',["success"=>"Data Insert Successfully."]);

    }

}
