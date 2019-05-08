<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use  App\Product;
use Webpatser\Uuid\Uuid;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance. And adds middlewares.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderByDesc('created_at')->get();
        return view('admin.products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validating the request
        $this->validate($request, [
            'product_name'=> 'required',
            'product_price'=> 'required',
            'product_description'=> 'required',
            'product_stock'=> 'required',
        ]);

        // Creating new Product
        $product = new Product;

        // Generating the Unique ID for Primary Key Column
        $uniqueId = Uuid::generate(4);
        // Checking if unique id already exists or not. If it does than recreating the unique id.
        if(Product::find($uniqueId)) {
            $uniqueId = Uuid::generate(4);
        }

        // Setting values of Product
        $product->product_id = $uniqueId;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_description = $request->product_description;
        $product->product_stock = $request->product_stock;
        $product->is_featured = $request->is_featured == 'true' ? true : false;
        $product->is_available = $request->is_available == 'true' ? true : false;
        $product->product_video = $request->product_video;

        if(Product::where('product_name', 'LIKE', $product->product_name)->exists()) {

            // Redericting the page with error message
            return redirect('/user/admin/products')->with('error', 'Product already exists in the store!');

        } else {
            // Saving the product in database.
            $product->save();
            
            // Redericting the page with success message
            return redirect('/user/admin/products')->with('success', 'Product added to the system successfully.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validating the request
        $this->validate($request, [
            'product_name'=> 'required',
            'product_price'=> 'required',
            'product_description'=> 'required',
            'product_stock'=> 'required',
        ]);

        // Creating new Product
        $product = Product::find($id);

        // Setting values of Product
        $product->product_old_price = $request->product_price != $product->product_price && $request->product_price > $product->product_price && $request->product_price > $product->product_old_price ? $product->product_price : '0';
        $product->product_price = $request->product_price;
        $product->product_description = $request->product_description;
        $product->product_stock = $request->product_stock;
        $product->is_featured = $request->is_featured == 'true' ? true : false;
        $product->is_available = $request->is_available == 'true' ? true : false;
        $product->product_video = $request->product_video;

        if($request->product_name != $product->product_name && Product::where('product_name', 'LIKE', $product->product_name)->exists()) {
            // Redericting the page with error message
            return redirect('/user/admin/products')->with('error', 'Product already exists in the store!');

        } else {
            // Saving the product in database.
            $product->save();
            
            // Redericting the page with success message
            return redirect('/user/admin/products')->with('success', 'Product Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/user/admin/products')->with('error', 'Product Deleted from the store.');
    }
}
