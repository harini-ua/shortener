<?php

namespace App\Listeners;

use App\Events\UrlClickEvent;

class UrlClickListener
{
    /**$event->
     * Handle the event.
     *
     * @param  \App\Events\UrlClickEvent  $event
     * @return void
     */
    public function handle(UrlClickEvent $event)
    {
        $event->url->increment('clicks');
    }
}
