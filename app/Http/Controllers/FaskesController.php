<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class FaskesController extends Controller
{
    /**
     * Display the Faskes page.
     */
    public function index(): View
    {
        return view('faskes');
    }
}
