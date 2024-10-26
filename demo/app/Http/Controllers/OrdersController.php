<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Http\Requests\OrdersRequest;
use Illuminate\Routing\Controller as BaseController;

class OrdersController extends BaseController
{
    public function get()
    {

    }

    public function post(OrdersRequest $request)
    {
        event(new OrderCreated($request->all()));

        return response()->json();
    }
}
