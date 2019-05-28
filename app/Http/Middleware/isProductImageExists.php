<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;
use App\ProductImage;

class isProductImageExists
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

        if ($request->route('image')) {

            // Saving product id from route
            $product_id = $request->route('product_id');

            // Saving color id from route
            $product_image_id = $request->route('image');

            // Checking if Product Exists or not.
            if (!$this->isProductImageExists($product_image_id)) {
                // Redirecting to the products index page with error
                return redirect("/user/admin/products/{$product_id}/images")
                    ->with('error', 'Product Image does not exists!');
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
     * Checks if the requested product color exists or not. If product color exists then it continues th system. But if it does not, it redirects to the product colors index page with the error message that product color does not exists.
     *
     * @param [type] $product_color_id
     * @return boolean
     */
    private function isProductImageExists($product_image_id) {

        // Saving product color
        $product_image = ProductImage::find($product_image_id);

        // Checking if product color is null or not
        if ($product_image == null) {
            // Returning false
            return false;
        } else {
            // Returning true
            return true;
        }
    }
}
