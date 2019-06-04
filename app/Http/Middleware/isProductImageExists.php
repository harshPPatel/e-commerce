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
        // Saving product id from route
        $product_id = $request->route('product_id');

        // Checking if Product Exists or not.
        if (!$this->isProductExists($product_id)) {
            // Redirecting to the products index page with error
            return redirect("/user/admin/products")
                ->with('error', 'Product does not exists!');
        } 

        if ($request->has('image')) {
            // Saving color id from route
            $product_image_id = $request->route('image');

            // Checking if Product Exists or not.
            if (!$this->isProductImageExists($product_image_id)) {
                // Redirecting to the products index page with error
                return redirect("/user/admin/products/". $product_id. "/images")
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
        // Saving output result
        $output = false; 

        // Finding product 
        $product = Product::find($product_id);

        // Checking if product is null or not
        if ($product == null) {
            // returning false
            $output =  false;
        } else {
            // returning true
            $output =  true;
        }
        //returing the value
        return $output;
    }

    /**
     * Checks if the requested product color exists or not. If product color exists then it continues th system. But if it does not, it redirects to the product colors index page with the error message that product color does not exists.
     *
     * @param [type] $product_color_id
     * @return boolean
     */
    private function isProductImageExists($product_image_id) {
        // Saving output result
        $output = false;

        // Saving product color
        $product_image = ProductImage::find($product_image_id);

        // Checking if product color is null or not
        if ($product_image == null) {
            // Returning false
            $output = false;
        } else {
            // Returning true
            $output = true;
        }
        
        // returning the output value
        return $output;
    }
}
