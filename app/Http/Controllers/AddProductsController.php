<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class AddProductsController extends Controller
{
    private $product; // saves product typed product
    private $sizes;
    private $colors;
    private $datasheets;
    /**
     * Create a new controller instance. And adds middlewares.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createProduct() {
        return view('admin.products.add');
    }

    public function submitProduct() {
    }

    public function createSize(Request $request) {
        $newProduct = new Product;
        $newProduct->product_name = $request->product_name;
        $newProduct->product_price = $request->product_price;
        $newProduct->product_description = $request->product_description;
        $newProduct->product_stock = $request->product_stock;
        $newProduct->is_featured = $request->is_featured;
        $newProduct->is_available = $request->is_available;
        $newProduct->product_video = $request->product_video;

        $this->product = $newProduct;
        return view('admin.productSizes.add');
    }

    public function editSize() {

    }

    public function submitSize() {

    }

    public function createColor() {
        
    }

    public function editColor() {

    }

    public function submitColor() {

    }

    public function createDataSheet() {
        
    }

    public function editDataSheet() {

    }

    public function submitDataSheet() {

    }

    public function saveProduct() {
        // send to products with success message
    }

    public function errorHandller() {
        return redirect('user/admin/products')->with('error', 'Bad Request. Complete the process with all steps.');
    }

    public function cancel() {
        $this->product = null;
        $this->sizes = null;
        $this->colors = null;
        $this->datasheets = null;
        return redirect('/user/admin/products')->with('error', 'Process Cancelled!');
    }
}
