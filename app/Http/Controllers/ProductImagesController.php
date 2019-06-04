<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use Webpatser\Uuid\Uuid;
use Storage;

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
            ->orderByDesc('created_at')
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

        // Creating new ProductImage
        $productImage = new ProductImage;
        $productImage->product_image_id = $this->createUniqueId();
        $productImage->is_featured = $validData['is_featured'];
        $productImage->product_id = $product_id;
        
        // Checking if teh Product Image already exists in the database or not
        if ($this->isProductImageExists($productImage)) {
            // returning back with error message
            return back()
            ->with('error', 'Product Image already exists');
        } 
        else {
            // Finding the Product
            $product = Product::find($product_id);
            // Setting image name
            $imageExtension = request()->product_image->getClientOriginalExtension();
            $imageName = time() . "_$product->product_name.$imageExtension";
            // Saving Image to server
            request('product_image')->storeAs('public/productImages', $imageName);

            // Saving image name to database
            $productImage->product_image = $imageName;
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
    public function edit($product_id, ProductImage $image)
    {
        // Fetching Product Images for requested product 
        $productImages = ProductImage
            ::productImages($product_id)
            ->orderByDesc('created_at')
            ->get();

        // Returning the view with variables
        return view('admin.productImages.edit')
            ->with([
                'product_id' => $product_id,
                'productImages' => $productImages,
                'productImage' => $image,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id, $image)
    {
        // Validate Data
        $validData = $request->validate([
            'product_image' => 'image|nullable|max:2048',
            'is_featured' => 'required|boolean',
        ]);

        // Creating new ProductImage
        $productImage = ProductImage:: find($image);
        $productImage->is_featured = $validData['is_featured'];

        // Checking if teh Product Image already exists in the database or not
        if ($this->isProductImageExists($productImage)) {
            // returning back with error message
            return back()
                ->with('error', 'Product Image already exists');
        } 
        else if ($this->isFeaturedProductImageExists($productImage)) {
            // returning back with error message
            return back()
                ->with('error', 'Featured image for the product already exists!');
        }
        else {
            // Checking if new file is added or not
            if ($request->has('product_image')){
                // saving old name to delete image
                $oldImagePath = $productImage->product_image;

                // Finding the Product
                $product = Product::find($product_id);
                // Setting image name
                $imageExtension = request()->product_image->getClientOriginalExtension();
                $imageName = time() . "_$product->product_name.$imageExtension";
                // Saving Image to server
                request('product_image')->storeAs('productImages', $imageName, 'public');
    
                // Setting productImage's product_image
                $productImage->product_image = $imageName;
            }
            
            // Saving product image
            $productImage->update();

            // Deleting old file if file is uploaded
            if ($oldImagePath) {
                Storage::delete('public/productImages/'.$oldImagePath);
            }

            // Returning back with success message
            return redirect("/user/admin/products/$product_id/images")
                ->with('success', 'Product Image added to the database successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id, $image)
    {
        // Finding the image
        $productImage = ProductImage::find($image);

        // Saving old image path
        $oldImagePath = $productImage->product_image;

        // Deleting the image
        $productImage->delete();

        // Deleting the image from storage
        Storage::delete('public/productImages/'.$oldImagePath);

        // Redirecting back with error message
        return back()
            ->with('success', 'Product Deleted Successfully!');
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
                ['product_image_id', '<>', $productImage->product_image_id],
                ['product_id', $productImage->product_id],
                ['product_image', '=', $productImage->product_image],
            ])
            ->exists();
    }

    /**
     * Checks if isFeaeturedImage Already exists or not for the products.
     *
     * @param ProductImage New or Updated product image row
     * @return boolean true if it exists; flase otherwise
     */
    private function isFeaturedProductImageExists($productImage)
    {
        // Checks if $productImage is featured image or not
        if ($productImage->is_featured == 1){
            // Returning value
            return ProductImage
                ::where([
                    ['product_image_id', '<>', $productImage->product_image_id],
                    ['product_id', $productImage->product_id],
                    ['is_featured', 1],
                ])
                ->exists();
        }
        else {
            return false;
        }
    }
}
