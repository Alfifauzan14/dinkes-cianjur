<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PPIDController extends Controller
{
    /**
     * Display the PPID page.
     */
    public function index(): View
    {
        return view('ppid');
    }
}
