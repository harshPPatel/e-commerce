<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductDatasheet;
use Webpatser\Uuid\Uuid;

class ProductsDatasheetsController extends Controller
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
        $this->middleware('isProductDatasheetExists');
    }

    /**
     * Display a listing of the resource.
     *
     * @param String $product_id - Id of the Product
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        // Fetching all datasheets for provided product
        $productDatasheets = ProductDatasheet
            ::productDatasheets($product_id)
            ->orderByDesc('created_at')
            ->get();

        // Returning the view with all datasheets
        return view('admin.productDatasheets.index')
            ->with([
                'productDatasheets' => $productDatasheets,
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
     * @param  \Illuminate\Http\Request  $request Request Made to the server
     * @param String $product_id Id of the Product Id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
        // Valildating the data
        $validData = $request->validate([
            'specification_name' => 'required|string',
            'specification_value' => 'required|string',
        ]);

        // Creating new Product Datasheet
        $productDatasheet = new ProductDatasheet;

        // Setting the values
        $productDatasheet->product_datasheet_id = $this->createUniqueId();
        $productDatasheet->specification_name = ucwords($validData['specification_name']);
        $productDatasheet->specification_value = ucwords($validData['specification_value']);
        $productDatasheet->product_id = $product_id;

        // checking if datasheet for the product already exists or not
        if ($this->isProductDatasheetExists($productDatasheet)) {

            // Returning back with error message
            return back()
                ->with('error', 'Datasheet for this product already exists!');
        } 
        else {
            // Saving Datasheet
            $productDatasheet->save();

            // Redirecting back with success message
            return back()
                ->with('success', 'Datasheet added for the product successfully!');
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
     * @param String $product_id Id of the Product
     * @param String $datasheet Id of the Product Datasheet
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id, $datasheet)
    {
        // Fetching Product Datasheets for requested product 
        $productDatasheets = ProductDatasheet
            ::productDatasheets($product_id)
            ->orderByDesc('created_at')
            ->get();

        // Finding the datahseet
        $productDatasheet = ProductDatasheet::find($datasheet);

        // Returning the view with variables
        return view('admin.productDatasheets.edit')
            ->with([
                'product_id' => $product_id,
                'productDatasheets' => $productDatasheets,
                'productDatasheet' => $productDatasheet,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $product_id - Id Of the Product
     * @param  String  $datasheet - Id Of the Product Datasheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id, $datasheet)
    {
        // Valildating the data
        $validData = $request->validate([
            'specification_name' => 'required|string',
            'specification_value' => 'required|string',
        ]);

        // Finding Product Datasheet
        $productDatasheet = ProductDatasheet::find($datasheet);

        // checking if update datasheet is valid or not
        if($this->isUpdateProductDatasheetExists($validData, $productDatasheet)) {

            // Returning back with error message
            return back()
                ->with('error', 'Datasheet for this product already exists!');
        } 
        else {
            // Setting the values
            $productDatasheet->specification_name = ucwords($validData['specification_name']);
            $productDatasheet->specification_value = ucwords($validData['specification_value']);
            // Updating Datasheet
            $productDatasheet->update();

            // Redirecting back with success message
            return redirect("/user/admin/products/{$product_id}/datasheets")
                ->with('success', 'Datasheet updated for the product successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $product_id - Id Of the Product
     * @param  String  $datasheet - Id Of the Product Datasheet
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id, $datasheet)
    {
        // fetching the datasheet
        $productDatasheet = ProductDatasheet::find($datasheet);

        // Deleting the datasheet
        $productDatasheet->delete();

        // Rederecting to the user
        return back()
            ->with('success', 'Product Datasheet Deleted successfully');    
    }

    /**
     * Creates unique id for the primary key field of product datasheet. It also checks to the dataase that if any other product datasheet with the same unique Id exists, it regenrates the uniqueId.
     *
     * @return string uniqueId
     */
    private function createUniqueId() {
        // Generating Unique ID
        $uniqueId = Uuid::generate(4);

        // Checking if unique id already exists or not. If it does than recreating the unique id.
        if(ProductDatasheet::find($uniqueId)) {
            // Calling the function again to create new unique id
            createUniqueId();
        }

        // Returning the unique Id
        return $uniqueId;
    }

    /**
     * Checks if the productDatasheet with same name already exists in the database for requested product or not
     *
     * @return boolean true, if it exists in the database; false if it does not exists in the database
     */
    private function isProductDatasheetExists($productDatasheet) {
        // Returning the value
        return ProductDatasheet
            ::where([
                ['product_id', $productDatasheet->product_id],
                ['specification_name', 'LIKE', $productDatasheet->specification_name]
            ])
            ->exists();
    }

    /**
     * Checks if the new update datasheet is already exists in the database or not
     *
     * @param Array $validData Array fo valid Data from the request
     * @param ProductDatasheet $productDatasheet Database Product datasheet object
     * @return boolean true, if it exists in the database; false if it does not exists in the database
     */
    private function isUpdateProductDatasheetExists($validData, $productDatasheet) {
        
        // Cheking if request specification_name is different than database productSize
        if ($validData['specification_name'] != $productDatasheet->specification_name ) {
            // Returning the value
            return ProductDatasheet
                ::where([
                    ['product_id', $productDatasheet->product_id],
                    ['specification_name', 'LIKE', $productDatasheet->specification_name]
                ])
                ->exists();
        }
        else if ($validData['specification_value'] == $productDatasheet->specification_value) {
            return true;
        }
        else {
            return false;
        }
    }
}
