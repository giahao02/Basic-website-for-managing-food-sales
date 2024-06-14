<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Hiện trang login
    public function index(){
        return view('login.login');
    }
    // Xử lí khi mà người dùng ấn login
    public function store(Request $request)
    {
        // Kiểm tra trường username và password phải nhập, không thì trả về lỗi
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        // Khi mà người dùng nhập thì sẽ gọi Model User để thực hiện kiểm tra tài khoản và mật khẩu có khớp với lại trong Database bảng user không
        $user = User::where('email', $request->input('username'))
                    ->where('password', $request->input('password'))
                    ->first();
        // Nếu mà tồn tại thằng user có trong database khi check thì lưu user đó vào session
        if ($user) {
            session(['user' => $user]);
            // Chuyển sang trang chủ
            return redirect()->route('trangchu');
        } else {
            // Đăng nhập thất bại thì sẽ trả về error
            return back()->withErrors(["fail" => "Email hoặc mk không đúng"]);
        }
    }
    // Xoá đi session tên là user và chuyển hướng về route trang chủ
    public function dangxuat(Request $request){
        $request->session()->forget('user');
        return redirect()->route('trangchu');
    }
    
    
}
