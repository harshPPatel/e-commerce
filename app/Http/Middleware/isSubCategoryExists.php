<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;
use App\SubCategory;

class isSubCategoryExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $categories = Category::all();

        if ($categories->count() == 0) {

            // Rendering the view with sub categories
            return redirect('/user/admin/categories')
                ->with('error', 'No Category exists. Please add category first.');

        }
         else if (!$this->isSubCategoryExists($request)) {
            // Rendering the view with sub categories
            return redirect('/user/admin/categories')
                ->with('error', 'Requested Sub Category does not exists.');
        }

        return $next($request);
    }

    /**
     * Checks if sub category exists in databse or not
     *
     * @param Request $request - Request made to the server
     * @return boolean true if exists; false otherwise
     */
    private function isSubCategoryExists($request) {
        // Saves return value of function
        $output = true;
        
        // Cheking if route has subcategory in url
        if ($request->route('subcategory')) {
            
            // Saving sub category id form url
            $sub_category_id = $request->route('subcategory'); 

            // Finding sub category in database
            $subCategory = SubCategory::find($sub_category_id);

            // Checking if result is null or not
            if ($subCategory == null) {
                // Setting output to false
                $output =  false;
            } else {
                // Setting output to true
                $output =  true;
            }
        }

        // returning the output
        return $output;
    }
}
