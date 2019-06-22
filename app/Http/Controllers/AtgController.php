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

    		'name'	=>	'required|alpha_spaces|unique:persons',
    		'email'	=>	'required|email|unique:persons',
    		'pin'	=>	'required|unique:persons|digits:6',

    	]);

    	$person = new Atg();

    	$person->name = $request->post('name');
    	$person->email = $request->post('email');
    	$person->pin = $request->post('pin');

    	$person->save();
        
        \Session::flash('success', 'Data Insert Successfully.');
        
    	return redirect()->route('home');

    }

}
