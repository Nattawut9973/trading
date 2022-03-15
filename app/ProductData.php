<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class ProductData extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_id', 'price'];

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $table = 'product_data';


    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
