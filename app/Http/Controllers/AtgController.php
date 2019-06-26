<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Atg;
use Session;

class AtgController extends Controller
{
    use \App\Traits\AtgTrait;

    public function index()
    {
        $data = Atg::all()->toArray();
        
    	return view('Atg',["persons"=>$data]);

    }

    public function storeandview(Request $request)
    {
        $result = $this->store($request);
        
        if($result["status"])
            Session::flash('success', $result["msg"]);
        else
            Session::flash('error', $result["msg"]);

        return redirect()->back()->withInput();
    }


}
