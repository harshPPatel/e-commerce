<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class isCategoryExists
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
        // Cheking if category parameter exists in route
        if ($request->route('category')) {

            // Saving category id from route
            $category_id = $request->route('category');

            // Checking if Category Exists or not.
            if (!$this->isCategoryExists($category_id)) {
                // Redirecting to the categories index page with error
                return redirect('/user/admin/categories')
                    ->with('error', 'Category does not exists!');
            } 
        }
        // Calling next method
        return $next($request);
    }

    /**
     * Checks if the requested category exists or not. If category exists then it continues th system. But if it does not, it redirects to the categories index page with the error message that category does not exists.
     *
     * @param string $category_id - The requested id inside the url
     * @return boolean true, if category exists in database; false otherwise
     */
    private function isCategoryExists($category_id) {
        // Finding category to edit
        $category = Category::find($category_id);

        // Checks if category is null
        if ($category == null) {
            // returning false
            return false;
        } else {
            // returning true
            return true;
        }
    }
}
