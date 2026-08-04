<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramKesehatanController extends Controller
{
    /**
     * Display a listing of the health programs.
     */
    public function index()
    {
        $programs = ProgramKesehatan::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.program.index', compact('programs'));
    }

    /**
     * Show the form for creating a new health program.
     */
    public function create()
    {
        return view('admin.program.create');
    }

    /**
     * Store a newly created health program in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'stat_1_num' => 'nullable|string|max:255',
            'stat_1_label' => 'nullable|string|max:255',
            'stat_2_num' => 'nullable|string|max:255',
            'stat_2_label' => 'nullable|string|max:255',
            'stat_3_num' => 'nullable|string|max:255',
            'stat_3_label' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'intervensi_titles' => 'nullable|array',
            'intervensi_titles.*' => 'nullable|string|max:255',
            'intervensi_descs' => 'nullable|array',
            'intervensi_descs.*' => 'nullable|string',
            'status' => 'required|in:published,draft',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        if (ProgramKesehatan::where('slug', $slug)->exists()) {
            $slug .= '-'.rand(100, 999);
        }

        $intervensi = [];
        if ($request->has('intervensi_titles')) {
            foreach ($request->intervensi_titles as $index => $title) {
                if (! empty($title)) {
                    $intervensi[] = [
                        'title' => $title,
                        'description' => $request->intervensi_descs[$index] ?? '',
                    ];
                }
            }
        }

        ProgramKesehatan::create([
            'title' => $request->title,
            'slug' => $slug,
            'subtitle' => $request->subtitle,
            'stat_1_num' => $request->stat_1_num,
            'stat_1_label' => $request->stat_1_label,
            'stat_2_num' => $request->stat_2_num,
            'stat_2_label' => $request->stat_2_label,
            'stat_3_num' => $request->stat_3_num,
            'stat_3_label' => $request->stat_3_label,
            'content' => $request->content,
            'intervensi' => $intervensi,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.program-kesehatan.index')
            ->with('success', 'Program Kesehatan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified health program.
     */
    public function edit(ProgramKesehatan $programKesehatan)
    {
        $program = $programKesehatan;

        return view('admin.program.edit', compact('program'));
    }

    /**
     * Update the specified health program in storage.
     */
    public function update(Request $request, ProgramKesehatan $programKesehatan)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'stat_1_num' => 'nullable|string|max:255',
            'stat_1_label' => 'nullable|string|max:255',
            'stat_2_num' => 'nullable|string|max:255',
            'stat_2_label' => 'nullable|string|max:255',
            'stat_3_num' => 'nullable|string|max:255',
            'stat_3_label' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'intervensi_titles' => 'nullable|array',
            'intervensi_titles.*' => 'nullable|string|max:255',
            'intervensi_descs' => 'nullable|array',
            'intervensi_descs.*' => 'nullable|string',
            'status' => 'required|in:published,draft',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        if (ProgramKesehatan::where('slug', $slug)->where('id', '!=', $programKesehatan->id)->exists()) {
            $slug .= '-'.rand(100, 999);
        }

        $intervensi = [];
        if ($request->has('intervensi_titles')) {
            foreach ($request->intervensi_titles as $index => $title) {
                if (! empty($title)) {
                    $intervensi[] = [
                        'title' => $title,
                        'description' => $request->intervensi_descs[$index] ?? '',
                    ];
                }
            }
        }

        $programKesehatan->update([
            'title' => $request->title,
            'slug' => $slug,
            'subtitle' => $request->subtitle,
            'stat_1_num' => $request->stat_1_num,
            'stat_1_label' => $request->stat_1_label,
            'stat_2_num' => $request->stat_2_num,
            'stat_2_label' => $request->stat_2_label,
            'stat_3_num' => $request->stat_3_num,
            'stat_3_label' => $request->stat_3_label,
            'content' => $request->content,
            'intervensi' => $intervensi,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.program-kesehatan.index')
            ->with('success', 'Program Kesehatan berhasil diperbarui.');
    }

    /**
     * Remove the specified health program from storage.
     */
    public function destroy(ProgramKesehatan $programKesehatan)
    {
        $programKesehatan->delete();

        return redirect()->route('admin.program-kesehatan.index')
            ->with('success', 'Program Kesehatan berhasil dihapus.');
    }
}
