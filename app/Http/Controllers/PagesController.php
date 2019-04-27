<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Represents Controller for Pages. Handles pages get requests from Routes.
 */
class PagesController extends Controller
{
    /**
     * Handles index request of the website and renders index view.
     *
     * @return void
     */
    public function index() {
        return view('pages.index');
    }
}
