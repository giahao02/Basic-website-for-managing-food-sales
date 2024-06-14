<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request)
    {
        $user = User::where('email',  $request->email)
                        ->where('password',  $request->password)
                        ->first();
        if ($user) {
            return response()->json(['message' => 'Đăng nhập thành công'],200);
        } else {
            return response()->json(['message' => 'Đăng nhập không thành công'], 401);
        }    
    }
}
