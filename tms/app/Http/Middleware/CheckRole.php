<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (! $request->user()) {
            // Redirect to login or show unauthorized message if user is not authenticated
            return redirect()->route('login');
        }

        // Check if user has admin or manager role
        if ($request->user()->hasAnyRole('admin', 'manager')) {
            // Admin and manager have full access
            return $next($request);
        }

        // For regular users, only allow access to view and update tasks
        if ($request->routeIs('tasks.index') || $request->routeIs('tasks.show') || 
            $request->routeIs('tasks.edit') || $request->routeIs('tasks.update')) {
            return $next($request);
        }

        // For any other routes, show unauthorized message
        abort(403, 'Unauthorized action.');
    }
}
