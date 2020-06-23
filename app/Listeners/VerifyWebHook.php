<?php

namespace App\Listeners;

use App\Events\WebHooks;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VerifyWebHook
{
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
     * @param  WebHooks  $event
     * @return void
     */
    public function handle(WebHooks $event)
    {
        
        $jsonBody = json_encode($event->data['body']);
        $appSecreyKey = 'a577674a0a24ba5de0e8b143ff63b29641e467006328ea508db11966991493e9';
        $signatureHiweb = $event->data['signatureHiweb'];
        $key = hash_hmac('sha256', json_encode($jsonBody), $appSecreyKey);
        $valid = $key == $signatureHiweb;
        var_dump($valid);

        return $valid;
    }
}
