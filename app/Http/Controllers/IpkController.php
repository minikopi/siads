<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IpkController extends Controller
{
    public function index()
    {
        return view('ipk.index');
    }
}
