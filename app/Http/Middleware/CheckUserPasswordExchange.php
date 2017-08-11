<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Support\Facades\DB;

class CheckUserPasswordExchange
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
        if (isset($request->grant_type) && $request->grant_type === 'password') {
            $response = $next($request);

            if ($response->getStatusCode() === 200) {
                if (Auth::once([
                    'email' => $request->has('password') ? $request->username : null,
                    'password' => $request->has('password') ? $request->password : null
                ])) {
                    $user = Auth::user();
                    if (!empty($user->password_backup)) {
                        $password = $user->password_backup;
                        $password_backup = null;

                        $query = 'update users set password = ?, password_backup = ? where id = ?';
                        $bindings = [$password, $password_backup, $user->id];
                        DB::update($query, $bindings);
                    }
                }
            }

            return $response;
        }
        return $next($request);
    }
}
