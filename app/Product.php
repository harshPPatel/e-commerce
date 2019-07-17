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
     * Creates the has Many relation with ProductSize Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Product Sizes related to the product
     */
    public function productSizes() {
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    /**
     * Creates the belongs to relation with SubCategory Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo Sub category to which the product belongs to
     */
    public function productSubCategory() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function productCategory() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Creates the has many relation with ProductColor Model
     *
     * @return hasMany - Colors belongs to the product
     */
    public function productColors() {
        return $this->hasMany(ProductColor::class, 'product_id');
    }

    /**
     * Creates the has many relation with ProductDatasheet Model
     *
     * @return hasMany - Datasheets belongs to the product
     */
    public function productDatasheets() {
        return $this->hasMany(ProductDatasheet::class, 'product_id');
    }

    /**
     * Creates the has many relation with ProductImage Model
     *
     * @return hasMany - Datasheets belongs to the product
     */
    public function productImages() {
        return $this->hasMany('App\ProductImage', 'product_id');
    }

    public function productFeaturedImage() {
        return ProductImage::where([
            ['product_id', $this->product_id],
            ['is_featured', 1],
        ])->first();
    }
}
