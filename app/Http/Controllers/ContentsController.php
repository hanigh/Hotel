<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentsController extends Controller
{
    //

    public function home(Request $request)
    {
        $data=[];
        $data['version']='0.1.2';
        $request->session()->put('key', 'mijn session value here');

        return  view('contents/home',$data);


    }
}
