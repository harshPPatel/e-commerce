<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductDatasheet;

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
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        // Fetching all sizes for provided sizes
        $productDatasheets = ProductDatasheet
            ::productDatasheets($product_id)
            ->orderByDesc('created_at')
            ->get();

        // Returning the view with all sizes for defined 
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
