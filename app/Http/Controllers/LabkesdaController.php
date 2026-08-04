<?php

namespace App\Http\Controllers;

use App\Models\LabkesdaCategory;
use App\Models\LabkesdaSetting;
use Illuminate\View\View;

class LabkesdaController extends Controller
{
    /**
     * Display the Labkesda page.
     */
    public function index(): View
    {
        $settings = LabkesdaSetting::firstOrCreate(['id' => 1]);
        $categories = LabkesdaCategory::with('items')->orderBy('order_index')->get();

        return view('labkesda', compact('settings', 'categories'));
    }
}
