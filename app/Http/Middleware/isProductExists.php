<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;

class isProductExists
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
        // Cheking if product parameter exists in route
        if ($request->route('product')) {

            // Saving product id from route
            $product_id = $request->route('product');

            // Checking if Product Exists or not.
            if (!$this->isProductExists($product_id)) {
                // Redirecting to the products index page with error
                return redirect('/user/admin/products')
                    ->with('error', 'Product does not exists!');
            } 
        }
        // Calling next method
        return $next($request);
    }

    /**
     * Checks if the requested category exists or not. If category exists then it continues th system. But if it does not, it redirects to the categories index page with the error message that category does not exists.
     *
     * @param string $product_id - The requested id inside the url
     * @return boolean true, if category exists in database; false otherwise
     */
    private function isProductExists($product_id) {
        // Finding category
        $product = Product::find($product_id);

        // Checks if product is null
        if ($product == null) {
            // returning false
            return false;
        } else {
            // returning true
            return true;
        }
    }
}
