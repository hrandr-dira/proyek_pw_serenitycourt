<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        return view('customer.support');
    }
}
