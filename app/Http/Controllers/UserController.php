<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function token_index()
    {
        $tokens = auth()->user()->tokens();
        return view('user.token.index')->with('tokens',$tokens);
    }
}
