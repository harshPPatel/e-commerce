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
}