<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;
use App\Category;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
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
        // Fetching all categories from Category Modal
        $categories = DB::table('categories')
            ->join('sub_categories', 'categories.category_id', '=', 'sub_categories.category_id', 'left outer')
            ->select('categories.category_id', 'categories.category_name', DB::raw('(CASE WHEN COUNT(sub_categories.sub_category_id) IS NULL THEN "0" ELSE COUNT(sub_categories.sub_category_id) END) AS "sub_category_count"'))
            ->groupBy(['category_id', 'category_name'])
            ->get();

        // Returning to category view with the value of all categories.
        return view('admin.categories.index')->with('categories', $categories);
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
        // Validating the request
        $this->validate($request, [
            'category_name'=> 'required'
        ]);

        // Creating Category Object
        $category = new Category;
        $uniqueId = Uuid::generate(4);
        // Checking if unique id already exists or not. If it does than recreating the unique id.
        if(Category::find($uniqueId)) {
            $uniqueId = Uuid::generate(4);
        }
        $category->category_id = $uniqueId;
        $category->category_name = $request->category_name;
        if(Category::where('category_name', 'LIKE', $category->category_name)->exists()) {
            return redirect('/user/admin/categories')->with('error', 'Category already exists.');
        } else {
            $category->save();
            return redirect('/user/admin/categories')->with('success', 'Category Added.');
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
        // Fetching all categories from Category Modal
        $categories = DB::table('categories')
            ->join('sub_categories', 'categories.category_id', '=', 'sub_categories.category_id', 'left outer')
            ->select('categories.category_id', 'categories.category_name', DB::raw('(CASE WHEN COUNT(sub_categories.sub_category_id) IS NULL THEN "0" ELSE COUNT(sub_categories.sub_category_id) END) AS "sub_category_count"'))
            ->groupBy(['category_id', 'category_name'])
            ->get();

        // Finding category to edit
        $category = Category::find($id);

        // returning view with variables
        return view('admin.categories.edit')
            ->with([
                'categories' => $categories,
                'category' => $category
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
            'category_name'=> 'required'
        ]);

        // Creating Category Object
        $category = Category::find($id);
        $category->category_name = $request->category_name;

        // Checking if the category with same name exist or not
        if(Category::where('category_name', 'LIKE', $category->category_name)->exists()) {
            return redirect('/user/admin/categories')->with('error', 'Category already exists.');
        } else {
            $category->save();
            return redirect('/user/admin/categories')->with('success', 'Category Edited.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/user/admin/categories')->with('error', 'Category Deleted.');
    }

}