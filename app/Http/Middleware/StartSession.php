<?php

namespace App\Http\Middleware;
use Session;
use Closure;
use Illuminate\Support\Facades\Event;
use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use Aacotroneo\Saml2\Events\Saml2LogoutEvent;

class StartSession
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
        Event::listen('Aacotroneo\Saml2\Events\Saml2LoginEvent', function (Saml2LoginEvent $event) {
          $user = $event->getSaml2User();
          $userInfo = $user->getAttributes();
          $username = $userInfo['User.email'][0];
          Session::put('username',$username);
          Session::put('isFromOneLogin',true);
        });
        Event::listen('Aacotroneo\Saml2\Events\Saml2LogoutEvent', function ($event) {
            Session::flush();
        });
        return $next($request);
    }
}
