<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
        return view('index');
    }

    public function login(): View
    {
        return view('login');
    }

    public function help(): View
    {
        return view('help');
    }

    public function errorReport(): View
    {
        return view('errorReport');
    }

    public function malfunction(): View
    {
        return view('malfunction');
    }

    public function ideas(): View
    {
        return view('ideas');
    }
}
