<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProductImage extends Model
{
    /**
     * @var string Table Name
     */
    protected $table = 'product_images';
    /**
     * @var string Primary Key of the Table.
     */
    public $primaryKey = 'product_image_id';
    /**
     * @var bool Value for timestamps
     */
    public $timestamps = true;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Scope the query to get images only for requested product
     *
     * @param Query $query - query to execute
     * @param string $productId - Id of product
     * @return void images for requested product
     */
    public function scopeProductImages($query, $productId) {
        return $query->where('product_id', $productId);
    }

    /**
     * Creates belongs to relation with Product Model
     *
     * @return belongsTo - product related to the Product Image
     */
    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
