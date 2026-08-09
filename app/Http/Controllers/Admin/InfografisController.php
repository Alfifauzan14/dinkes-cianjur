<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infografis;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class InfografisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Infografis::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        $infografis = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.infografis.index', compact('infografis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.infografis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/infografis');
            if (! File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $image->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        }

        Infografis::create($data);

        return redirect()->route('admin.infografis.index')->with('success', 'Infografis berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Infografis $infografi): View
    {
        return view('admin.infografis.edit', ['infografis' => $infografi]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Infografis $infografi): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/infografis');
            if (! File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            if ($infografi->image) {
                $oldImagePath = public_path('uploads/infografis/'.$infografi->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        }

        $infografi->update($data);

        return redirect()->route('admin.infografis.index')->with('success', 'Infografis berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infografis $infografi): RedirectResponse
    {
        if ($infografi->image) {
            $imagePath = public_path('uploads/infografis/'.$infografi->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $infografi->delete();

        return redirect()->route('admin.infografis.index')->with('success', 'Infografis berhasil dihapus!');
    }
}
