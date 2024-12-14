<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DBConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $connection = config('database.default');

        if(Auth::check()){
            $user = Auth::user();

            $connection = match ($user->role_id){
                1 => 'pgsql_tourist',
                2 => 'pgsql_tourguide',
                3 => 'pgsql_touristofficer',
                default => config('database.default'),
            };
        }

        DB::purge($connection);
        config(['database.default' => $connection]);
        DB::reconnect($connection);

        DB::statement("SET myapp.user_id = ". (int) $user->user_id);

        return $next($request);


    }
}
