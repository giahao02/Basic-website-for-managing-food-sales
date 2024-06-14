<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // public function index(){
    //         $name = 'Duc';
    //         $names= array('Kevin','Hieu','Nghia');
    //         return view('products.about',
    //         [
    //             'names' => $names
    //         ]
    //     );
    // }

    // public function kiki(){
    //     return view('products.kiki');
    // }

    public function index1(){
        return view('index1');
    }
}
