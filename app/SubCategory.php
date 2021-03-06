<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    /**
     * @var string Table Name
     */
    protected $table = 'sub_categories';
    /**
     * @var string Primary Key of the Table.
     */
    public $primaryKey = 'sub_category_id';
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
     * Creates relation between SubCategory and Category Modal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo The name of related modal.
     */
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Creates hasMany relation with Product Modal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany The products belongs to the sub category 
     */
    public function products() {
        return $this->hasMany(Product::class, 'sub_category_id');
    }
}
