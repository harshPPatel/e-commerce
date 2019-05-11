<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class SubCategoriesController extends Controller
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
        // Fetching all Categories
        $categories = Category::all();

        // Fetching all sub categories
        $subCategories = DB::table('sub_categories')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.category_id')
            ->select('sub_categories.*', 'categories.category_name')
            ->get();

        // Checking if any Parent Category is available or not
        if ($categories->count() > 0) {
            // Rendering the view with sub categories
            return view('admin.subcategories.index')
                ->with([
                    'subCategories' => $subCategories,
                    'categories' => $categories,
                ]);
        } else {
            // Redirecting to Categories with Error
            return redirect('/user/admin/categories')->with('error', 'Add Category first to create Sub Categories.');
        }

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
            'sub_category_name'=> 'required',
            'category_id' => 'required',
        ]);

        // Creating Category Object
        $subCategory = new SubCategory;

        // Generating UUID for Subcategory.
        $uniqueId = Uuid::generate(4);

        // Checking if unique id already exists or not. If it does than recreating the unique id.
        if(SubCategory::find($uniqueId)) {
            $uniqueId = Uuid::generate(4);
        }

        // Setting variables of subCategory
        $subCategory->sub_category_id = $uniqueId;
        $subCategory->sub_category_name = $request->sub_category_name;
        $subCategory->category_id = $request->category_id;

        // Validating if same category exists in sub_categories table for same parent category.
        if(SubCategory::
            where([
                ['sub_category_name', 'LIKE', $subCategory->sub_category_name],
                ['category_id', '=', $subCategory->category_id]
            ])->exists()) {
            return redirect('/user/admin/subcategories')->with('error', 'Sub Category already exists.');
        } else {

            // Saving sub category
            $subCategory->save();

            // Redirecting to subcategories page with success message.
            return redirect('/user/admin/subcategories')->with('success', 'Sub Category Added.');
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
        // Fetching all sub categories
        $subCategories = DB::table('sub_categories')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.category_id')
            ->select('sub_categories.*', 'categories.category_name')
            ->get();

        // Fetching Sub Category to be edited
        $subCategory = SubCategory::find($id);

        // returning view with variables
        return view('admin.subcategories.edit')
            ->with([
                'subCategories' => $subCategories,
                'subCategory' => $subCategory,
                'categories' => Category::all(),
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
            'sub_category_name'=> 'required',
            'category_id' => 'required'
        ]);

        // Finding Sub Category Object
        $subCategory = SubCategory::find($id);

        // Updating values
        $subCategory->sub_category_name = $request->sub_category_name;
        $subCategory->category_id = $request->category_id;

        // Checking if the sub category with same name exist or not inside selected parent category
        if(SubCategory
            ::where([
                ['sub_category_name', 'LIKE', $subCategory->sub_category_name],
                ['category_id' , '=', $subCategory->category_id]
                ])->exists()) {
            return redirect('/user/admin/subcategories')->with('error', 'Sub Category already exists in selected parent Category..');
        } else {
            $subCategory->save();
            return redirect('/user/admin/subcategories')->with('success', 'Sub Category Edited.');
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
     * Displays list of sub categories for specific category.
     *
     * @param $id Category ID
     */
    public function categoryIndex($id) {
        // Fetching all Categories
        $categories = Category::all();

        // Fetching all sub categories with category name
        $subCategories = DB::table('sub_categories')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.category_id')
            ->select('sub_categories.*', 'categories.category_name')
            ->where('sub_categories.category_id', '=', $id)
            ->get();

        // Fetching Parent Category Name
        $parentCategory = Category::find($id)->category_name;

        // Checking if any Parent Category is available or not
        if ($categories->count() > 0) {
            // Rendering the view with sub categories
            return view('admin.subcategories.index')
                ->with([
                    'subCategories' => $subCategories,
                    'categories' => $categories,
                    'pageHeading' => $parentCategory,
                ]);
        } else {
            // Redirecting to Categories with Error
            return redirect('/user/admin/categories')->with('error', 'Category Does not exists. Add Category first.');
        }
    }
}
