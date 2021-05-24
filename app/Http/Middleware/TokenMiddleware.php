<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;

class TokenMiddleware
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
        $requestToken = $request->header('x-51talk-session-id');
        if ($requestToken === null) {
            return response([
                'success' => false,
                'status' => 401,
                'message' => 'You are not Authorized to make this request.',
            ], 401);
        }
        $activeToken = User::where('token', $requestToken)
            ->where('token_expired_at', '>=', Carbon::now())->first();
        if (null !== $activeToken) {
            $activeToken->update(['token_expired_at' => Carbon::now()->addHours(3)]);
        }
        if (!$activeToken) {
            return response([
                'success' => false,
                'status' => 401,
                'message' => 'Session Expired or Invalid.',
            ], 401);
        }
        $request['userId'] = $activeToken->id;
        $request['projectId'] = $activeToken->project_id;
        return $next($request);
    }
}
