<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoSell extends Model
{
    protected $fillable = ['user_id', 'order_id', 'product_id', 'lower_price','higher_price'];

    protected $table = 'auto_sells';

    protected $primaryKey = 'id';

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
