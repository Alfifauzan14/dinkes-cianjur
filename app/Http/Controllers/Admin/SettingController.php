<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.setting.edit');
    }

    public function update(Request $request)
    {
        return redirect()->route('admin.setting.edit')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
