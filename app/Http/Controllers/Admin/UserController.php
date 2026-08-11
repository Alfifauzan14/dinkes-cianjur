<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'asc')->paginate(15);

        $gatekeeperUsername = Setting::get('gatekeeper_username', config('services.gatekeeper.username', 'admin'));
        $gatekeeperPassword = Setting::get('gatekeeper_password', config('services.gatekeeper.password', 'dinkes2026'));

        return view('admin.user.index', compact('users', 'gatekeeperUsername', 'gatekeeperPassword'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'is_admin' => 'boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->boolean('is_admin'),
            'is_active' => true,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'is_admin' => 'boolean',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->boolean('is_admin'),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password untuk '.$user->name.' berhasil direset.');
    }

    public function toggleActive(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri.');
        }

        $activeAdmins = User::where('is_admin', true)->where('is_active', true)->count();

        if ($user->is_admin && $user->is_active && $activeAdmins <= 1) {
            return back()->with('error', 'Tidak dapat menonaktifkan admin aktif terakhir.');
        }

        $user->update(['is_active' => ! $user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', 'Pengguna '.$user->name.' berhasil '.$status.'.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $activeAdmins = User::where('is_admin', true)->where('is_active', true)->count();

        if ($user->is_admin && $activeAdmins <= 1) {
            return back()->with('error', 'Tidak dapat menghapus admin aktif terakhir.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }

    public function updateGatekeeper(Request $request)
    {
        $request->validate([
            'gatekeeper_username' => 'required|string|max:255',
            'gatekeeper_password' => 'required|string|max:255',
        ]);

        Setting::set('gatekeeper_username', $request->input('gatekeeper_username'));
        Setting::set('gatekeeper_password', $request->input('gatekeeper_password'));

        return back()->with('success', 'Kredensial Gerbang Akses berhasil diperbarui.');
    }
}
