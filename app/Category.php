<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @var string Table Name
     */
    protected $table = 'categories';
    /**
     * @var string Primary Key of the Table.
     */
    public $primaryKey = 'category_id';
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
     * Creates relation between Category and SubCategory Modal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany The name of related modal
     */
    public function subCategories() {
        return $this->hasMany('App\SubCategory', 'category_id');
    }
}
