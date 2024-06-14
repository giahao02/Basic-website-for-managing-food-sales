<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class InforUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Hiện trang thông tin user và truyền các dữ liệu lấy được từ database vô view để hiện các trường của user đang đăng nhập
    public function index()
    {
        $idU= session('user.id');
        $user = User::where('id',$idU)->first();
        session(['user' => $user]);
        return view('user.inforuser',[
            'user' => $user
        ]);
    }  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Cập nhật thông tin user
    public function update(Request $request, $id)
    {   
        // Gọi model User kiểm tra user từ id truyền vào
        $user = User::where('id', $id)->first();
        // Nếu như mật khẩu cũ khác với mật khẩu user đó trong database thì trả về error
        if($request->input('oldPassword') != null){
            if ($request->input('oldPassword') != $user->password) {
                return back()->withErrors("Mật khẩu cũ không đúng");
        }
        }
        // Khi mà dữ liệu cập nhật khác với dữ liệu có sẵn trong database thì cập nhật nó lại
        if ($request->input('name') != $user->name) {
            $user->name = $request->input('name');
        }
        if ($request->input('email') != $user->email) {
            $user->email = $request->input('email');
        }
        if ($request->input('renewPassword') != $user->password && $request->input('renewPassword') !=null ) {
            $user->password = $request->input('renewPassword');
        }
        // Lưu vào cơ sở dữ liệu và chuyển hướng về trang thông tin user
        $user->save();
        return redirect('/infouser');
    }

    
}
