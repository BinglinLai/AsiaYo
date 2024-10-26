<?php

namespace App\Listeners;

use App\Currency;
use App\Events\OrderCreated;

class OrderRequest
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
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        //
        if (!in_array($event->orderData->currency, Currency::ALLOWED_CURRENCY)) {
            return;
        }

        //
        $model = '\\App\\Orders' . ucfirst(strtolower($event->orderData->currency));
        $model::create((array) $event->orderData);
    }
} 
