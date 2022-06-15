<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect()
    {
        if (Auth::user()->utype === 'A') {
            return redirect()->route('admin.dashboard');
        } else if (Auth::user()->utype === 'C') {
            return redirect()->route('shop');
        } else if (Auth::user()->utype === 'S') {
            return redirect()->route('seller.dashboard');
        } else if (Auth::user()->utype === 'D') {
            return redirect()->route('deliveryman.dashboard');
        }
    }
}
