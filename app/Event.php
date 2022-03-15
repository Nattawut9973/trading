<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'start_date', 'end_date', 'price'];

    protected $table = 'events';

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
