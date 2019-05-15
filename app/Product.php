<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var string Table Name
     */
    protected $table = 'products';
    /**
     * @var string Primary Key of the Table.
     */
    public $primaryKey = 'product_id';
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
     * Estalbishes the has Many relation with ProductSize Modal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Product Sizes related to the product
     */
    public function productSizes() {
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    /**
     * Establishes the belongs to relation with SubCategory Modal
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo Sub category to which the product belongs to
     */
    public function productSubCategory() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
