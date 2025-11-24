<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ConvertRedirectForFragment
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // if the request is a fragment/AJAX request and the controller returned a redirect,
        // convert it to JSON so the client-side loader can handle it gracefully.
        if (($request->ajax() || $request->query('fragment') == 1) && $response instanceof RedirectResponse) {
            $target = $response->getTargetUrl();
            $flash = session()->get('status') ?? session()->get('message') ?? null;
            // clear flash, since we're returning JSON
            session()->forget('status'); session()->forget('message');

            return response()->json([
                'redirect' => $target,
                'message' => $flash,
            ], 200);
        }

        return $response;
    }
}