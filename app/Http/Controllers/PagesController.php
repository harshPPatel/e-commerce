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

    /**
     * Handles About page request of the website and renders about view.
     *
     * @return void
     */
    public function about() {
        return view('pages.about');
    }
    
    /**
     * Handles Contact page request of the website and renders contact view.
     *
     * @return void
     */
    public function contact() {
        return view('pages.contact');
    }
}
