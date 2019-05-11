<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductSize;
use Webpatser\Uuid\Uuid;

class ProductSizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // Validating the input
        $this->validate($request, [
            'product_size' => 'required',
        ]);

        // Creating new Product Size
        $size = new ProductSize;

        // Generating the Unique ID for Primary Key Column
        $uniqueId = Uuid::generate(4);
        // Checking if unique id already exists or not. If it does than recreating the unique id.
        if(ProductSize::find($uniqueId)) {
            $uniqueId = Uuid::generate(4);
        }

        // Adding column values
        $size->product_size_id = $uniqueId;
        $size->product_size = strtoupper($request->product_size);
        $size->product_id = $id;

        // Checking if the size already exists or not
        if($this->isSizeExists($size, $id)) {
            // Redericting the page with error message
            return redirect("/user/admin/products/{$id}/sizes")->with('error', 'Size for provided product already exists!');

        } else {
            // Saving the product in database.
            $size->save();
            
            // Redericting the page with success message
            return redirect("/user/admin/products/{$id}/sizes")->with('success', 'Size added to the system successfully.');
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

        // Checking if any size exists or not
        if ($size != null) {
            return view('admin.productSizes.edit')
                ->with([
                    'sizes' => $sizes,
                    'product_id' => $product_id,
                    'editSize' => $size
                ]);
        } else {
            // handling bad requests for non exist sizes
            return redirect("/user/admin/products/{$product_id}/sizes")->with('error', 'Size Does not exists.');
        }
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
        $size->product_size = $request->product_size;

        // Checking if the category with same name exist or not
        if($this->isSizeExists($size, $product_id)) {
            // redirecting to the sizes page of product with error message
            return redirect("/user/admin/products/{$product_id}/sizes")->with('error', 'Size already exists for the product.');
        } 
        else {
            // saving the size
            $size->save();

            // redirecting to the sizes page of product with success message
            return redirect("/user/admin/products/{$product_id}/sizes")->with('success', 'Size updated successfully.');
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

        if ($size == null) {
            return redirect("/user/admin/products/{$product_id}/sizes")
                ->with('error', 'Product Size does not exists.');
        } 
        else {
            $size->delete();
            return redirect("/user/admin/products/{$product_id}/sizes")
                ->with('success', 'Product deleted successfully.');
        }
    }

    private function isSizeExists($size, $product_id) {
        return ProductSize::where([
            ['product_size', 'LIKE', $size->product_size],
            ['product_id', '=', $product_id]
        ])->exists();
    }
}
