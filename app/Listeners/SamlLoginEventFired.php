<?php

namespace App\Listeners;

//use App\Events\SamlLoginEvent;
use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class SamlLoginEventFired
{
    protected $event;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SamlLoginEvent  $event
     * @return void
     */
    public function handle()
    {
        //$user = $event->getSaml2User();
        echo '123';
    }
}
