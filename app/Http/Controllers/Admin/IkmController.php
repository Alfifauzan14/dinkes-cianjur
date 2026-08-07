<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IkmRating;

class IkmController extends Controller
{
    public function index()
    {
        $ratings = IkmRating::latest()->get();

        $stats = [
            'total' => $ratings->count(),
            'sangat_puas' => $ratings->where('rating', 'sangat_puas')->count(),
            'puas' => $ratings->where('rating', 'puas')->count(),
            'cukup' => $ratings->where('rating', 'cukup')->count(),
            'kurang' => $ratings->where('rating', 'kurang')->count(),
        ];

        return view('admin.ikm.index', compact('ratings', 'stats'));
    }
}
