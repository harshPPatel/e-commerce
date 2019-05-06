<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductSize;
use Webpatser\Uuid\Uuid;

class AddProductsController extends Controller
{
    private $product; // saves product typed product
    private $sizes = array();
    private $colors;
    private $datasheets;
    private $isProcessDone = false;
    /**
     * Create a new controller instance. And adds middlewares.
     *
     * @return void
     */
    public function __construct()
    {
        $this->isProcessDone = true;
        $this->middleware('auth');
    }

    public function createProduct() {
        return view('admin.products.add');
    }
    
    public function submitProduct(Request $request) {

        $this->isProcessDone = false;
        
        // Validating the request
        $this->validate($request, [
            'product_name'=> 'required',
            'product_price'=> 'required',
            'product_description'=> 'required',
            'product_stock'=> 'required',
        ]);

        $newProduct = new Product;

        $uniqueId = Uuid::generate(4);
        // Checking if unique id already exists or not. If it does than recreating the unique id.
        if(Product::find($uniqueId)) {
            $uniqueId = Uuid::generate(4);
        }
        $newProduct->product_id = $uniqueId;

        $newProduct->product_name = $request->product_name;
        $newProduct->product_price = $request->product_price;
        $newProduct->product_description = $request->product_description;
        $newProduct->product_stock = $request->product_stock;
        $newProduct->is_featured = $request->is_featured;
        $newProduct->is_available = $request->is_available;
        $newProduct->product_video = $request->product_video;
        
        $this->product = $newProduct;
        
        // $newProduct->save();
        return redirect('/user/admin/products/add/sizes');
    }

    public function createSizes() {
        if($this->isProcessDone) {
            return view('admin.productSizes.add');
        } else {
            return $this->errorHandller();
        }
    }

    public function editSize() {

    }

    public function submitSizes(Request $request) {
        // Validating the request
        $this->validate($request, [
            'product_size' => 'required',
        ]);
        
        $newSize = new ProductSize;

        $uniqueId = Uuid::generate(4);
        // Checking if unique id already exists or not. If it does than recreating the unique id.
        if(ProductSize::find($uniqueId)) {
            $uniqueId = Uuid::generate(4);
        }
        $newSize->product_size_id = $uniqueId;

        $newSize->product_size = $request->product_size;  
        // $newSize->product_id = $this->product->product_id;

        // $newSize->save();
        array_push($this->sizes, $newSize);

        return redirect('/user/admin/products/add/sizes')->with('sizes', $this->sizes);
    }

    public function createColors() {
        return 'Hello';
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
        $this->isProcessDone = true;
    }
    
    public function errorHandller() {
        return redirect('user/admin/products')->with('error', 'Bad Request. Complete the process with all steps.');
    }
    
    public function cancel() {
        $this->product = null;
        $this->sizes = null;
        $this->colors = null;
        $this->datasheets = null;
        $this->isProcessDone = false;
        return redirect('/user/admin/products')->with('error', 'Process Cancelled!');
    }
}
