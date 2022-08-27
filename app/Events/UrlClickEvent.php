<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UrlClickEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $url;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }
}
