<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use App\ProductSize;

class ProductSizesController extends Controller
{
    /**
     * Create a new controller instance. And adds middlewares.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isProductSizesExists');
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $product_id - Product's Id from route
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        // Fetching all sizes for provided sizes
        $sizes = ProductSize
            ::where('product_id', $product_id)
            ->orderByDesc('created_at')
            ->get();

        // Returning the view with all sizes for defined 
        return view('admin.productSizes.index')
            ->with([
                'sizes' => $sizes,
                'product_id' => $product_id
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request - Request made to the server
     * @param string $product_id - Product's Id from route
     */
    public function store(Request $request, $product_id)
    {
        // Validating the input
        $this->validate($request, [
            'product_size' => 'required',
        ]);

        // Creating new Product Size
        $size = new ProductSize;

        // Adding column values
        $size->product_size_id = $this->createUniqueId();
        $size->product_size = strtoupper($request->product_size);
        $size->product_id = $product_id;

        // Checking if the size already exists or not
        if($this->isSizeExists($size, $product_id)) {
            // Redericting the page with error message
            return redirect("/user/admin/products/{$product_id}/sizes")
                ->with('error', 'Size for provided product already exists!');

        } else {
            // Saving the product in database.
            $size->save();
            
            // Redericting the page with success message
            return redirect("/user/admin/products/{$product_id}/sizes")
                ->with('success', 'Size added to the system successfully.');
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
    public function edit($product_id, $id)
    {
        // Fetching all sizes for provided sizes
        $sizes = ProductSize
            ::where('product_id', $product_id)
            ->orderByDesc('created_at')
            ->get();

        // Fetching requested product
        $size = ProductSize::find($id);

        // Returning the view with variables
        return view('admin.productSizes.edit')
            ->with([
                'sizes' => $sizes,
                'product_id' => $product_id,
                'editSize' => $size
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id, $id)
    {
        // Validating the request
        $this->validate($request, [
            'product_size'=> 'required'
        ]);

        // Finding the product size
        $size = ProductSize::find($id);

        // Setting the values
        $size->product_size = strtoupper($request->product_size);

        // Checking if the category with same name exist or not
        if($this->isSizeExists($size, $product_id)) {
            // redirecting to the sizes page of product with error message
            return redirect("/user/admin/products/{$product_id}/sizes")
                ->with('error', 'Size already exists for the product.');
        } 
        else {
            // saving the size
            $size->save();

            // redirecting to the sizes page of product with success message
            return redirect("/user/admin/products/{$product_id}/sizes")
                ->with('success', 'Size updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id, $id)
    {
        // Finding the product size
        $size = ProductSize::find($id);

        // Deleting the size
        $size->delete();

        // Returning to the products' sizes index page with success message
        return redirect("/user/admin/products/{$product_id}/sizes")
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Checks if product size with the same name already exists for same products and returns boolean value
     *
     * @param ProductSize $size - Product Size
     * @param string $product_id - Product's id from the route 
     * @return boolean true if product already exists; false if it does not.
     */
    private function isSizeExists($size, $product_id) {
        return ProductSize::where([
            ['product_size', 'LIKE', $size->product_size],
            ['product_id', '=', $product_id]
        ])->exists();
    }

    /**
     * Creates unique id for the primary key field of product size. It also checks to the dataase that if any other product size with the same unique Id exists, it regenrates the uniqueId.
     *
     * @return string uniqueId
     */
    private function createUniqueId() {
        // Generating the Unique ID for Primary Key Column
        $uniqueId = Uuid::generate(4);
        
        // Checking if unique id already exists or not. If it does than recreating the unique id.
        if(ProductSize::find($uniqueId)) {
            // Calling the function again to create new unique id
            createUniqueId();
        }

        // Returning the unique id
        return $uniqueId;
    }
}
