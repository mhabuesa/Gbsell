<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function accessDeny()
    {
        return view('merchant.accessDeny');
    }
}
