<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use Webpatser\Uuid\Uuid;

class ProductImagesController extends Controller
{
    /**
     * Create a new controller instance. And adds middlewares.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->middleware('isProductImageExists');
    }

    /**
     * Display a listing of the resource.
     *
     * @param String $product_id Id of the Product
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        // fetching all images for the product
        $productImages = ProductImage
            ::productImages($product_id)
            ->orderBy('created_at')
            ->get();

        // Returning the view with all datasheets
        return view('admin.productImages.index')
            ->with([
                'productImages' => $productImages,
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
    public function store(Request $request, $product_id)
    {
        // Validate the request
        $validData = $request->validate([
            'product_image' => 'required|image|max:2048',
            'is_featured' => 'required|boolean',
        ]);

        // Finding the Product
        $product = Product::find($product_id);
        // Setting image name
        $imageExtension = request()->product_image->getClientOriginalExtension();
        $imageName = time() . "_$product->product_name.$imageExtension";
        // Saving Image to server
        request('product_image')->storeAs('productImages', $imageName, 'public');

        // Creating new ProductImage
        $productImage = new ProductImage;
        $productImage->product_image_id = $this->createUniqueId();
        $productImage->product_image = 'productImages/' . $imageName;
        $productImage->is_featured = $validData['is_featured'];
        $productImage->product_id = $product_id;

        // Checking if teh Product Image already exists in the database or not
        if ($this->isProductImageExists($productImage)) {
            // returning back with error message
            return back()
            ->with('error', 'Product Image already exists');
        } 
        else {
            // Saving product image
            $productImage->save();

            // Returning back with success message
            return back()
                ->with('success', 'Product Image added to the database successfully.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Creates unique id for the primary key field of product image. It also checks to the dataase that if any other product image with the same unique Id exists, it regenrates the uniqueId.
     *
     * @return string uniqueId
     */
    private function createUniqueId() {
        // Generating Unique ID
        $uniqueId = Uuid::generate(4);

        // Checking if unique id already exists or not. If it does than recreating the unique id.
        if(ProductImage::find($uniqueId)) {
            // Calling the function again to create new unique id
            createUniqueId();
        }

        // Returning the unique Id
        return $uniqueId;
    }

    /**
     * Checks if the productImage with same name already exists in the image for requested product or not
     *
     * @return boolean true, if it exists in the image; false if it does not exists in the image
     */
    private function isProductImageExists($productImage) {
        // Returning the value
        return ProductImage
            ::where([
                ['product_id', $productImage->product_id],
                ['product_image', '=', $productImage->product_image],
            ])
            ->exists();
    }
}
