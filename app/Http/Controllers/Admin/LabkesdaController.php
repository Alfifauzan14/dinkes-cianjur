<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LabkesdaCategory;
use App\Models\LabkesdaSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabkesdaController extends Controller
{
    protected array $icons = [
        'science', 'water_drop', 'restaurant', 'biotech', 'medical_services',
        'local_hospital', 'health_and_safety', 'monitor_heart', 'bloodtype',
        'shield', 'verified', 'assignment_turned_in',
    ];

    public function index()
    {
        $categories = LabkesdaCategory::with('items')->orderBy('order_index')->get();

        return view('admin.labkesda.index', compact('categories'));
    }

    public function create()
    {
        $icons = $this->icons;

        return view('admin.labkesda.create', compact('icons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'badge_text' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'icon_name' => 'required|string',
            'items' => 'nullable|array',
            'items.*' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'title', 'description', 'badge_text', 'button_text', 'button_url', 'icon_name',
        ]);
        $data['order_index'] = LabkesdaCategory::max('order_index') + 1;

        DB::transaction(function () use ($request, $data) {
            $category = LabkesdaCategory::create($data);

            if ($request->has('items')) {
                foreach ($request->items as $index => $itemName) {
                    $trimmed = trim($itemName);
                    if ($trimmed !== '') {
                        $category->items()->create([
                            'item_name' => $trimmed,
                            'order_index' => $index,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.labkesda.index')
            ->with('success', 'Layanan Labkesda berhasil ditambahkan.');
    }

    public function edit(LabkesdaCategory $labkesda)
    {
        $labkesda->load('items');
        $icons = $this->icons;

        return view('admin.labkesda.edit', compact('labkesda', 'icons'));
    }

    public function update(Request $request, LabkesdaCategory $labkesda)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'badge_text' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'icon_name' => 'required|string',
            'items' => 'nullable|array',
            'items.*' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'title', 'description', 'badge_text', 'button_text', 'button_url', 'icon_name',
        ]);

        DB::transaction(function () use ($request, $labkesda, $data) {
            $labkesda->update($data);
            $labkesda->items()->delete();

            if ($request->has('items')) {
                foreach ($request->items as $index => $itemName) {
                    $trimmed = trim($itemName);
                    if ($trimmed !== '') {
                        $labkesda->items()->create([
                            'item_name' => $trimmed,
                            'order_index' => $index,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.labkesda.index')
            ->with('success', 'Layanan Labkesda berhasil diperbarui.');
    }

    public function destroy(LabkesdaCategory $labkesda)
    {
        $labkesda->delete();

        return redirect()->route('admin.labkesda.index')
            ->with('success', 'Layanan Labkesda berhasil dihapus.');
    }

    public function editSettings()
    {
        $settings = LabkesdaSetting::firstOrCreate(['id' => 1]);

        return view('admin.labkesda.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'alamat' => 'nullable|string|max:255',
            'jam_operasional' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
        ]);

        $settings = LabkesdaSetting::firstOrCreate(['id' => 1]);
        $settings->update($request->only('alamat', 'jam_operasional', 'kontak'));

        return redirect()->route('admin.labkesda.settings.edit')
            ->with('success', 'Informasi Kontak Labkesda berhasil diperbarui.');
    }

    public function move(Request $request, LabkesdaCategory $labkesda)
    {
        $request->validate([
            'direction' => 'required|in:up,down',
        ]);

        $all = LabkesdaCategory::orderBy('order_index')->orderBy('id')->get();
        $position = $all->pluck('id')->values()->search($labkesda->id);

        if ($position === false) {
            return response()->json(['success' => false]);
        }
        if ($request->direction === 'up' && $position === 0) {
            return response()->json(['success' => false]);
        }
        if ($request->direction === 'down' && $position === $all->count() - 1) {
            return response()->json(['success' => false]);
        }

        $swapPosition = $request->direction === 'up' ? $position - 1 : $position + 1;

        DB::transaction(function () use ($all, $position, $swapPosition) {
            $ids = $all->pluck('id')->all();
            [$ids[$position], $ids[$swapPosition]] = [$ids[$swapPosition], $ids[$position]];

            foreach ($ids as $i => $id) {
                LabkesdaCategory::where('id', $id)->update(['order_index' => $i + 1]);
            }
        });

        return response()->json(['success' => true]);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:labkesda_categories,id',
        ]);

        $ids = $request->input('ids');
        DB::transaction(function () use ($ids) {
            foreach ($ids as $index => $id) {
                LabkesdaCategory::where('id', $id)->update(['order_index' => $index + 1]);
            }
        });

        return response()->json(['success' => true]);
    }
}
