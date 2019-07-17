<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

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
        $categories = Category::orderBy('category_name')->get();
        $electronicCategory = Category::where('category_name', 'LIKE', 'ELECTRONICS')->first();
        $menFashionCategory = Category::where('category_name', 'LIKE', 'MEN FASHION')->first();
        $womenFashionCategory = Category::where('category_name', 'LIKE', 'WOMEN FASHION')->first();
        $featuredProducts = Product::where([['is_available', 1], ['is_featured', 1]])->orderBy('created_at', 'desc')->limit(3)->get();
        return view('pages.index')
            ->with([
                'categories' => $categories,
                'featuredProducts' => $featuredProducts,
                'electronicCategory' => $electronicCategory,
                'menFashionCategory' => $menFashionCategory,
                'womenFashionCategory' => $womenFashionCategory,
            ]);
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
