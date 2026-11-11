<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorAuthController extends Controller
{
    public function showLogin()
    {
        return view('vendor.login');
    }
}
