<?php

namespace App\Http\Controllers;

use App\Models\ProgramKesehatan;

class ProgramKesehatanController extends Controller
{
    /**
     * Display the specified health program.
     */
    public function show(string $slug)
    {
        $program = ProgramKesehatan::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        if ($slug === 'cianjur-bebas-stunting') {
            return view('program.stunting', compact('program'));
        }

        if ($slug === 'kesehatan-ibu-anak') {
            return view('program.kia', compact('program'));
        }

        return view('program.show', compact('program'));
    }
}
