<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;
use App\ProductSize;

class isProductSizesExists
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
        if ($request->route('product_id')) {

            // Saving product id from route
            $product_id = $request->route('product_id');

            // Checking if Product Exists or not.
            if (!$this->isProductExists($product_id)) {
                // Redirecting to the products index page with error
                return redirect("/user/admin/products")
                    ->with('error', 'Product does not exists!');
            } 
        } 
        else if ($request->route('size')) {

            // Saving product id from route
            $product_id = $request->route('product_id');

            // Saving size id from route
            $product_size_id = $request->route('size');

            // Checking if Product Exists or not.
            if (!$this->isProductSizeExists($product_size_id)) {
                // Redirecting to the products index page with error
                return redirect("/user/admin/products/{$product_id}/sizes")
                    ->with('error', 'Product Size does not exists!');
            } 
        }
        
        // Calling next method
        return $next($request);
    }

    /**
     * Checks if the requested product exists or not. If product exists then it continues th system. But if it does not, it redirects to the product sizes index page with the error message that product does not exists.
     *
     * @param string $product_id - The requested id inside the url
     * @return boolean true, if product exists in database; false otherwise
     */
    private function isProductExists($product_id) {
        // Finding product 
        $product = Product::find($product_id);

        // Checking if product is null or not
        if ($product == null) {
            // returning false
            return false;
        } else {
            // returning true
            return true;
        }
    }

    /**
     * Checks if the requested product size exists or not. If product size exists then it continues th system. But if it does not, it redirects to the product sizes index page with the error message that product size does not exists.
     *
     * @param [type] $product_size_id
     * @return boolean
     */
    private function isProductSizeExists($product_size_id) {

        // Saving product size
        $product_size = ProductSize::find($product_size_id);

        // Checking if product size is null or not
        if ($product_size == null) {
            // Returning false
            return false;
        } else {
            // Returning true
            return true;
        }
    }
}
