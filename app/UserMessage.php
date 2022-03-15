<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    protected $table = 'user_messages';


    protected $fillable = [
        'user_id',
        'order_id',
        'product_id',
        'value',
        'lower',
        'higher',
        'status',
        'notify',
    ];

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('User','user_id');
    }

    public function order()
    {
        return $this->belongsTo('Order','order_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
