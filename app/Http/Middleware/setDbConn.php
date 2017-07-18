<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class setDbConn
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
        $dbName = isset(Session::get('company')->db_name) ? Session::get('company')->db_name : false;
        if ($dbName) {
            \Config::set('database.connections.mysql.database', $dbName);
            return $next($request);
        } else {
            \Auth::logout();
            return redirect('/domain')->with('message', 'please login again to continue..!');
        }
    }
}

