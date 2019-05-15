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
        $this->middleware('isSubCategoryExists');
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
        $subCategories = SubCategory::all();

        // Rendering the view with sub categories
        return view('admin.subcategories.index')
            ->with([
                'subCategories' => $subCategories,
                'categories' => $categories,
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
        // Validating the request
        $data = $request->validate([
            'sub_category_name' => 'required',
            'category_id' => 'required',
        ]);

        // Creating Category Object
        $subCategory = new SubCategory;

        // Setting variables of subCategory
        $subCategory->sub_category_id = $this->createUniqueId();
        $subCategory->sub_category_name = $data['sub_category_name'];
        $subCategory->category_id = $data['category_id'];

        // Validating if same category exists in sub_categories table for same parent category.
        if($this->isSubCategoryExists($subCategory)) {
            return redirect('/user/admin/subcategories')
                ->with('error', 'Sub Category already exists.');
        } else {
            // Saving sub category
            $subCategory->save();

            // Redirecting to subcategories page with success message.
            return redirect('/user/admin/subcategories')
                ->with('success', 'Sub Category Added.');
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
        $subCategories = SubCategory::all();

        // Fetching Sub Category to be edited
        $subCategory = SubCategory::find($id);
        
        // Checking if provided id is not Other Subcategories id
        if ($subCategory->sub_category_id == env('OTHERS_SUB_CATEGORY_ID')) {
            // returning back with error
            return back()
                ->with('error', 'You Can not edit this Category!');
        }

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
        $validatedData = $request->validate([
            'sub_category_name'=> 'required',
            'category_id' => 'required'
        ]);

        // Finding Sub Category Object
        $subCategory = SubCategory::find($id);

        // Updating values
        $subCategory->sub_category_name = $validatedData['sub_category_name'];
        $subCategory->category_id = $validatedData['category_id'];

        // Checking if the sub category with same name exist or not inside selected parent category
        if($this->isSubCategoryExists($subCategory)) {
            // Redirecting to the sub categories index page with error message
            return redirect('/user/admin/subcategories')
                ->with('error', 'Sub Category already exists in selected parent Category..');
        } 
        else {
            // Updating sub category
            $subCategory->update();
                
            // Redirecting to the sub categories index page with success message
            return redirect('/user/admin/subcategories')
                ->with('success', 'Sub Category Edited.');
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
        // Finding the sub category
        $subCategory = SubCategory::find($id);

        // Checking if provided id is not Other Subcategories id
        if ($subCategory->sub_category_id == env('OTHERS_SUB_CATEGORY_ID')) {
            // returning back with error
            return back()->with('error', 'You Can not delete this Category!');
        }

        // Deleting the sub category
        $subCategory->delete();

        // Redirecting to the same page with success message
        return redirect()->back()->with('success', 'Sub Category deleted successfully!');
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
        $subCategories = SubCategory
            ::where('category_id', '=', $id)
            ->get();

        // Fetching Parent Category Name
        $parentCategory = Category::find($id)->category_name;

        // Rendering the view with variables
        return view('admin.subcategories.index')
            ->with([
                'subCategories' => $subCategories,
                'categories' => $categories,
                'pageHeading' => $parentCategory,
            ]);
    }

    /**
     * Creates unique id for the primary key field of sub category. It also checks to the dataase that if any other sub category with the same unique Id exists, it regenrates the uniqueId.
     *
     * @return string uniqueId
     */
    private function createUniqueId() {
        // Generating UUID for Subcategory.
        $uniqueId = Uuid::generate(4);

        // Checking if unique id already exists or not. If it does than recreating the unique id.
        if(SubCategory::find($uniqueId)) {
            createUniqueId();
        }

        // Returning the unique id
        return $uniqueId;
    }

    /**
     * Checks if sub category already exists in database with same name and for same parent category
     *
     * @param SubCategory $subCategory - Sub category to compare in database
     * @return boolean true if it exists, false otherwise
     */
    private function isSubCategoryExists($subCategory) {
        return SubCategory
            ::where([
                ['sub_category_name', 'LIKE', $subCategory->sub_category_name],
                ['category_id', '=', $subCategory->category_id]
            ])->exists();
    }
}
