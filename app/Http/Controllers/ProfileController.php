<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the public Profile Dinkes page.
     */
    public function index(): View
    {
        $profile = Profile::first();

        return view('profil', compact('profile'));
    }
}
