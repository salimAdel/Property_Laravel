<?php

namespace App\Http\Middleware;

use App\Models\Privilege;
use App\Models\Role;
use App\Models\RoleBasedPrivilege;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRolePrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role= auth()->user()->role;


          return response()->json("nononnonononno");
    }
}
