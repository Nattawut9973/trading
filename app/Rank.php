<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $table = 'ranks';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'nav', 'percent_nav'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
