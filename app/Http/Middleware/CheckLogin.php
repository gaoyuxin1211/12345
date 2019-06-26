<?php

namespace App\Http\Middleware;

use Closure;

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
        // dd($request->session()->get('uid'));
       //  if(!$request->session()->get('pid')){
       //  return redirect('/');
       // }
       $time=date('H');
        if ($time<9 || $time>17) {
            // 拒绝进入
            return \redirect('/huo/list');
        }
        return $next($request);
    }
}
