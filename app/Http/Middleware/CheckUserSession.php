<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (session('user') === null) {
            // Session 'user' không tồn tại, trả về session tạm thời có sẵn trong request tiếp theo là trở về trang hiện tại 
            return back()->with('nologin','Bạn chưa đăng nhập'); 
        }
        // Nếu thành công thì trả về request tiếp theo
        return $next($request);
    }
}
