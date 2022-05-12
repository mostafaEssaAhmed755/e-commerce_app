<?php

namespace Modules\Customers\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getOrders()
    {
        $orders = auth()->user()->orders;

        return view('frontend.pages.account.orders', compact('orders'));
    }
}
