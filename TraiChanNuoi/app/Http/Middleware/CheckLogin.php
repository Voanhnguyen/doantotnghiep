<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::get('nhanvien') == null) {
            Session::flash('message', 'Bạn vui lòng đăng nhập để tiếp tục.');
            return redirect('/dang-nhap.html');
        }

        return $next($request);
    }
}
