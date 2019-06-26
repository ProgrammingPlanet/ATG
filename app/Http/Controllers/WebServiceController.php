<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class WebServiceController extends Controller
{
	use \App\Traits\AtgTrait;

    public function storeandresponce(Request $request)
    {

        $result = $this->store($request);
        return json_encode($result);
    }


}
