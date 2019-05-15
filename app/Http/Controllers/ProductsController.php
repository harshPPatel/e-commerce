<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use App\Product;
use App\Category;
use App\SubCategory;

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
        $this->middleware('isProductExists');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetching all products in descending order of the time they were created
        // $products = Product::orderByDesc('created_at')->get();
        $products = Product::all();
        
        // Returning the view with variables
        return view('admin.products.index')
            ->with([
                'products' => $products
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Fetching all sub categories
        $subCategories = SubCategory::all();

        // Fetching all categories
        $categories = Category::all();

        // Returning view with variables
        return view('admin.products.add')
            ->with([
                'categories' => $categories,
                'subCategories' => $subCategories
            ]);
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
        $validData = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'product_price' => ['required', 'numeric'],
            'product_description' => ['required', 'string'],
            'product_stock' => ['required', 'numeric'],
            'is_featured' => ['required', 'boolean'],
            'is_available' => ['required', 'boolean'],
            'product_video' => ['mimetypes:video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/s-ms-wmv,video/mpeg,video/avi'],
            'sub_category_id' => ['required', 'string'],
        ]);

        // Creating new Product
        $product = new Product;

        // Setting values of Product
        $product->product_id = $this->createUniqueId();
        $product->product_name = $validData['product_name'];
        $product->product_price = $valiData['product_price'];
        $product->product_description = $valiData['product_description'];
        $product->product_stock = $validDate['product_stock'];
        $product->is_featured = $validData['is_featured'];
        $product->is_available = $validData['is_available'];
        $product->product_video = $validData['product_video'];
        $product->sub_category_id = $this->isSubCategoryExists($request->sub_category_id) 
            ? $request->sub_category_id 
            : env('OTHERS_SUB_CATEGORY_ID');

        // Cheking if product with same name exists or not
        if(Product::where([
            ['product_name', 'LIKE', $product->product_name],
            ['sub_category_id', '=', $product->sub_category_id]
        ])->exists()) {

            // Redericting the page with error message
            return redirect('/user/admin/products')
                ->with('error', 'Product already exists in the store!');

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
        // Finding the product
        $product = Product::find($id);

        // Fetching all sub categories
        $subCategories = SubCategory::all();

        // Fetching all categories
        $categories = Category::all();

        // Returning view with variables
        return view('admin.products.edit')
            ->with([
                'product' => $product,
                'categories' => $categories,
                'subCategories' => $subCategories
            ]);
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
        $product->sub_category_id = $this->isSubCategoryExists($request->sub_category_id)
            ? $validData['sub_category_id']
            : env('OTHERS_SUB_CATEGORY_ID');

        // Checking if the product already exists with same product name in the same sub category or not
        if ($this->isEditedProductExists($request, $product)) {
            // Redericting the page with error message
            return redirect('/user/admin/products')
                ->with('error', 'Product already exists in the store!');
        } 
        else {
            // Updating name of product after validation
            $product->product_name = $request->product_name;

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
        // Finding the product
        $product = Product::find($id);

        // Deleting the product
        $product->delete();

        // Redirecting to products index page with success message
        return redirect('/user/admin/products')
            ->with('success', 'Product Deleted from the store.');
    }

    /**
     * Creates unique id for the primary key field of product. It also checks to the dataase that if any other product with the same unique Id exists, it regenrates the uniqueId.
     *
     * @return string uniqueId
     */
    private function createUniqueId() {
        // Generating the Unique ID for Primary Key Column
        $uniqueId = Uuid::generate(4);
        
        // Checking if unique id already exists or not. If it does than recreating the unique id.
        if(Product::find($uniqueId)) {
            // Calling the function again to create new unique id
            createUniqueId();
        }

        // Returning the unique id
        return $uniqueId;
    }

    /**
     * Checks of the provided sub category for product is exists or not.
     *
     * @param string $sub_category_id - Id of selected sub category
     * @return boolean true if it exists; false if it does not.
     */
    private function isSubCategoryExists($sub_category_id) {

        // Cheking the sub_category_id in database
        if (SubCategory::find($sub_category_id)) {
            // returning true
            return true;
        } else {
            // returning false
            return false;
        }
    }

    /**
     * Checks if the edited product already exists in the database or not
     *
     * @param Request $request
     * @param Product $product
     * @return boolean true if the product with same name in the same category exists; false if it does not.
     */
    private function isEditedProductExists($request, $product) {
        return $validData['product_name'] != $product->product_name 
            && Product::where([
                ['product_name', 'LIKE', $request->product_name],
                ['sub_category_id', '=', $product->sub_category_id]
            ])->exists();
    }
}
