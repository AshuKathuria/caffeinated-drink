<?php

  namespace App\Http\Middleware;

  use Closure;

  class BasicAuthMiddleware
  {
      /**
       * Handle an incoming request.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  \Closure  $next
       * @return mixed
       */
      public function handle($request, Closure $next) {
          if($request->getUser() != config('extra_config.auth_user') || $request->getPassword() != config('extra_config.auth_password')) {
              return response()->json([
                'success' => false,
                'status' => 401,
                'message' => 'Unauthorized'
              ], 401);
          }
          return $next($request);
      }
  }