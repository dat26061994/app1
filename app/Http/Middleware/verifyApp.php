<?php

namespace App\Http\Middleware;

use Closure;

class verifyApp
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
        $signatureTime = isset($request["signature_time"]) ? $request["signature_time"] : 0;
        $websiteId = isset($request["website_id"]) ? $request["website_id"] : "";
        $signature = isset($request["signature"]) ? $request["signature"] : "";
        $appSecret = config('app.APP_SECRET_KEY');
        $timeout = config('app.timeout');
        $now = strtotime("now");
        $checkApp = hash_hmac('sha256', hash_hmac('sha256', $websiteId, $signatureTime), $appSecret);

        

        if ($checkApp == $signature && ($now - (int) $signatureTime) < $timeout) {
            
            return $next($request);

        }else{
            
            return redirect('/403');

        }

        return $next($request);
        
    }
}
