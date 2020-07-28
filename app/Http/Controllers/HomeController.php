<?php

namespace App\Http\Controllers;

use App\Models\Cupboard;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Home page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cupboards = Cupboard::all();
        return view('index', compact('cupboards'));
    }
}
