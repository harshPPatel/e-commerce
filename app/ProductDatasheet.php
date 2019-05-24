<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProductDatasheet extends Model
{
    /**
     * @var string Table Name
     */
    protected $table = 'product_datasheets';
    /**
     * @var string Primary Key of the Table.
     */
    public $primaryKey = 'product_datasheet_id';
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
     * Scope the query to get datasheets only for requested product
     *
     * @param Query $query - query to execute
     * @param string $productId - Id of product
     * @return void datasheets for requested product
     */
    public function scopeProductDatasheets($query, $productId) {
        return $query->where('product_id', $productId);
    }

    /**
     * Creates belongs to relation with Product Model
     *
     * @return belongsTo - product related to the Product datasheet
     */
    public function product() {
        return $this->belongsTo(Product::class, 'product_datasheet_id');
    }
}
