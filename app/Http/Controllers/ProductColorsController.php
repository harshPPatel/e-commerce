<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductColor;
use App\Rules\Color;
use Webpatser\Uuid\Uuid;

class ProductColorsController extends Controller
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
        $this->middleware('isProductColorExists');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        // Fetching Product Colors for requested product 
        $productColors = ProductColor::productColors($product_id)->get();

        // Returning the view with variables
        return view('admin.productColors.index')
            ->with([
                'product_id' => $product_id,
                'productColors' => $productColors
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
        // Valildating the data
        $validData = $request->validate([
            'product_color' => ['color', 'required'],
            'color_name' => 'required|string'
        ]);

        // Creating new Product Color
        $productColor = new ProductColor;

        // Setting the values
        $productColor->product_color_id = $this->createUniqueId();
        $productColor->color_name = ucwords($validData['color_name']);
        $productColor->product_color = $validData['product_color'];
        $productColor->product_id = $product_id;

        // checking if color for the product already exists or not
        if ($this->isProductColorExists($productColor)) {

            // Returning back with error message
            return back()
                ->with('error', 'Color for this product already exists!');
        } 
        else {
            // Saving Color
            $productColor->save();

            // Redirecting back with success message
            return back()
                ->with('success', 'Color added for the product successfully!');
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
    public function edit($product_id, $color)
    {
        // Fetching Product Colors for requested product 
        $productColors = ProductColor::productColors($product_id)->get();

        $productColor = ProductColor::find($color);

        // Returning the view with variables
        return view('admin.productColors.edit')
            ->with([
                'product_id' => $product_id,
                'productColors' => $productColors,
                'color' => $productColor,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id, $color)
    {
        $validData = $request->validate([
            'color_name' => ['required', 'string'],
            'product_color' => ['required', 'color'],
        ]);

        // Fetching the product
        $productColor = ProductColor::find($color);

        // Updating the values
        $productColor->color_name = ucwords($validData['color_name']);
        $productColor->product_color = $validData['product_color'];

        // Checking if edited color already exists in the database or not
        if ($this->isProductColorExists($productColor)) {
            // returning view with error message
            return back()
            ->with('error', 'Color with the same name already exists for the Product!');
        } 
        else {
            // Updating the color
            $productColor->update();
            
            // returning view with success message
            return redirect("user/admin/products/{$product_id}/colors")
                ->with('success', 'Product colors added successfully!');
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
        //
    }

    /**
     * Creates unique id for the primary key field of product color. It also checks to the dataase that if any other product color with the same unique Id exists, it regenrates the uniqueId.
     *
     * @return string uniqueId
     */
    private function createUniqueId() {
        // Generating Unique ID
        $uniqueId = Uuid::generate(4);

        // Checking if unique id already exists or not. If it does than recreating the unique id.
        if(ProductColor::find($uniqueId)) {
            // Calling the function again to create new unique id
            createUniqueId();
        }

        // Returning the unique Id
        return $uniqueId;
    }

    /**
     * Checks if the producColor with same name already exists in the database for requested product or not
     *
     * @return boolean true, if it exists in the database; false if it does not exists in the database
     */
    private function isProductColorExists($productColor) {
        // Returning the value
        return ProductColor
        ::where([
            ['product_id', $productColor->product_id],
            ['product_color', 'LIKE', $productColor->product_color]
        ])
        ->orWhere([
            ['product_id', $productColor->product_id],
            ['color_name', 'LIKE', $productColor->color_name]
        ])
        ->exists();
    }
}
