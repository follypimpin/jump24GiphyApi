<?php

namespace App\Http\Middleware;

use Closure;

class ETagMiddleware
{
    /**
     * Implements Etag support in the header
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get response
        $response = $next($request);
        // If this was a GET request...
        if ($request->isMethod('get')) {
            // Generate Etag
            $eTag = md5($response->getContent());
            $requestEtag = str_replace('"', '', $request->getETags());
            // Check to see if Etag has changed
            if($requestEtag && $requestEtag[0] === $eTag) {
                $response->setNotModified();
            }
            // Set Etag
            $response->setEtag($eTag);
        }
        // Send response
        return $response;
    }
}
