<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LabkesdaController extends Controller
{
    /**
     * Display the Labkesda page.
     */
    public function index(): View
    {
        return view('labkesda');
    }
}
