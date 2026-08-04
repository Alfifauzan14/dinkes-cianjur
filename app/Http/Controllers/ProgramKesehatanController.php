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

        return view('program.show', compact('program'));
    }
}
