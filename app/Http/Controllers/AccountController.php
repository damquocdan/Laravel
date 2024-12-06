<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // Show account information
    public function index()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('account.index', compact('user'));
    }

    // Show edit form for account information
}
