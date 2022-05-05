<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Session;
class Role
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $quyen = Session::get('quyen');
        if ($quyen != $role) {
            return redirect('/not-role.html');
        }
 
        return $next($request);
    }
 
}