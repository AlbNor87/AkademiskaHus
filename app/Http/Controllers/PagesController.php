<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\User;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class PagesController extends Controller
{
    /**
     * Display the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $user = User::with('posts')->first();

        return view('index', [
            'name' => $user->name,
            'posts' => $user->posts,
        ]);
    }

    public function login(): View
    {
        return view('login');
    }
}